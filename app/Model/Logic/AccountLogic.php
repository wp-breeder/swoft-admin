<?php declare(strict_types=1);


namespace App\Model\Logic;


use App\Bean\AuthManger;
use App\Bean\AuthResult;
use App\Bean\AuthSession;
use App\Contract\AccountTypeInterface;
use App\Exception\ApiException;
use App\Exception\AuthException;
use App\Helper\TokenParserHelper;
use App\Model\Dao\UserDao;
use App\Model\Data\RoleMenuData;
use App\Model\Data\UserData;
use App\Model\Data\UserRoleData;
use App\Model\Entity\User;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Exception\DbException;
use function array_column;

/**
 * Class AccountLogic
 * @Bean()
 */
class AccountLogic implements AccountTypeInterface
{
    /**
     * @Inject()
     * @var UserData
     */
    protected $userData;

    /**
     * @Inject()
     * @var TokenParserHelper
     */
    protected $tokenParser;

    /**
     * @Inject()
     * @var UserRoleData
     */
    protected $userRoleData;

    /**
     * @Inject()
     * @var RoleMenuData
     */
    protected $roleMenuData;

    /**
     * @Inject()
     * @var AuthManger
     */
    protected $authManger;

    const ROLE = 'role';

    /**
     * @param array $logInfo
     * @return AuthResult
     * @throws ReflectionException
     * @throws ContainerException
     * @throws ApiException
     */
    public function login(array $logInfo): AuthResult
    {
        $identity   = $logInfo['identity'];
        $credential = $logInfo['credential'];
        /** @var User $user */
        $user   = $this->userData->getUserByIdentify($identity);
        $result = AuthResult::new();
        if ($user && $this->verify($user, $credential) && $user->getStatus() === 1) {
            $result->setIdentity((string)$user->getUid());
        } else {
            throw new ApiException('Authentication: Invalid credential or account disabled', 400);
        }
        return $result;
    }

    /**
     * 验证id是否为用户id
     * @param string $identity
     * @return bool
     */
    public function authenticate(string $identity): bool
    {
        return $this->userData->issetUserById($identity);
    }

    /**
     * 校验用户信息
     * @param User $user
     * @param string $credential
     * @return bool
     */
    public function verify(User $user, string $credential): bool
    {
        $password = md5($user->getLoginName() . $credential . $user->getCreateTime());
        return $password === $user->getPassword();
    }

    /**
     * 创建密码
     * @param array $userInfo
     * @return string
     */
    public function createCredential(array $userInfo)
    {
        $password = md5($userInfo['login_name'] . $userInfo['credential'] . $userInfo['create_time']);

        return $password;
    }

    /**
     * 刷新token
     * @param string $token
     * @return AuthSession
     * @throws ContainerException
     * @throws ReflectionException
     * @throws AuthException
     */
    public function refreshToken(string $token)
    {
        /** @var AuthSession $session */
        $session = $this->tokenParser->getSession($token);
        $result  = AuthResult::new();
        $result->setIdentity($session->getIdentity());

        $newSession = $this->authManger->setCache(self::class, $result);

        return $newSession;
    }

    /**
     * 删除token
     * @param string $token
     * @return bool
     * @throws AuthException
     */
    public function delToken(string $token)
    {
        return $this->authManger->delCache($token);
    }

    /**
     * 创建用户
     * @param array $userInfo
     * @param string $token
     * @param array $clientInfo
     * @return bool
     * @throws ApiException
     */
    public function createUser(array $userInfo, string $token, array $clientInfo)
    {
        /** @var AuthSession $session */
        $session                 = $this->tokenParser->getSession($token);
        $userInfo['create_uid']  = $session->getIdentity();
        $userInfo['status']      = 1;
        $userInfo['create_time'] = date('Y-m-d H:i:s');
        $userInfo['ip']          = $clientInfo['remote_addr'];
        $userInfo['login_name']  = $userInfo['identity'];
        $userInfo['password']    = $this->createCredential($userInfo);
        $roleIds                 = $userInfo['role_ids'];
        unset($userInfo['role_ids']);
        unset($userInfo['identity']);
        unset($userInfo['credential']);
        $ret = $this->userData->createUser($userInfo);
        if ($ret) {
            $userRoleMapping = $this->createUserRoleMapping((int)$ret, $roleIds);
            $this->userRoleData->createUserRoleMapping($userRoleMapping);
        }

        return $ret;
    }

    /**
     * 获取用户ID
     * @param string $token
     * @return int
     */
    protected function getUid(string $token): int
    {
        /** @var AuthSession $session */
        $session = $this->tokenParser->getSession($token);
        return (int)$session->getIdentity();
    }

    /**
     * 获取账号
     * @param string $token
     * @return array
     */
    public function getAccount(string $token)
    {
        $uid  = $this->getUid($token);
        $user = $this->getUser($uid);

        return $user;
    }

    /**
     * 修改账户信息
     * @param array $userInfo
     * @param string $token
     * @return int
     */
    public function editAccount(array $userInfo, string $token)
    {
        $uid = $this->getUid($token);
        $ret = $this->userData->updateUser($uid, $userInfo);
        return $ret;
    }

    /**
     * 修改密码
     * @param array $userInfo
     * @param string $token
     * @return int
     * @throws AuthException
     */
    public function editPwd(array $userInfo, string $token)
    {
        $uid                 = $this->getUid($token);
        $user                = $this->userData->getUser($uid);
        $user['credential']  = $userInfo['credential'];
        $user['login_name']  = $user['loginName'];
        $user['create_time'] = $user['createTime'];
        $password            = $this->createCredential($user);
        $ret                 = $this->userData->updateUser($uid, ['password' => $password]);
        $this->delToken($token);
        return $ret;
    }

    /**
     * 重置密码
     * @param int $uid
     * @return int
     * @throws AuthException
     */
    public function resetPwd(int $uid)
    {
        $user     = $this->getUser($uid);
        $userInfo = [
            'credential'  => '00000000',
            'login_name'  => $user['login_name'],
            'create_time' => $user['create_time'],
        ];
        $this->authManger->delCacheById((string)$uid);
        $password = $this->createCredential($userInfo);
        return $this->userData->updateUser($uid, ['password' => $password]);
    }

    /**
     * 更新用户信息
     * @param int $uid
     * @param array $userInfo
     * @return int
     */
    public function updateUser(int $uid, array $userInfo)
    {
        if (isset($userInfo['role_ids']) && $userInfo['role_ids']) {
            //删除 用户角色映射关系
            $this->userRoleData->delUserRoleMappingById($uid);
            $mapping = $this->createUserRoleMapping($uid, $userInfo['role_ids']);
            $this->userRoleData->createUserRoleMapping($mapping);
        }

        return $this->userData->updateUser($uid, $userInfo);
    }

    /**
     * 创建映射关系
     * @param int $uid
     * @param string $roleIds
     * @return array
     */
    public function createUserRoleMapping(int $uid, string $roleIds)
    {
        $roleIds         = explode(',', $roleIds);
        $userRoleMapping = [];
        foreach ($roleIds as $roleId) {
            $userRoleMapping[] = [
                'uid'     => $uid,
                'role_id' => $roleId,
            ];
        }

        return $userRoleMapping;
    }

    protected function getRoleIdsByUid(int $uid)
    {
        $roleIds = $this->userRoleData->getRoleById($uid);
        return array_column($roleIds, 'roleId');
    }

    public function getButtons(int $uid)
    {
        $roleIds = $this->getRoleIdsByUid($uid);
        return $this->roleMenuData->getButtons($roleIds);
    }

    public function getMenus(int $uid)
    {
        $roleIds = $this->getRoleIdsByUid($uid);
        $menus   = $this->roleMenuData->getMenus($roleIds);
        return $this->genTree($menus, 'menu_id', 'parent_id', 'children');
    }

    public function genTree(array $list, string $pk = 'id', string $pid = 'pid', string $child = '_child', int $root = 0)
    {
        $tree     = [];
        $packData = [];
        foreach ($list as $data) {
            $packData[$data[$pk]] = $data;
        }
        foreach ($packData as $key => $val) {
            if ($val[$pid] == $root) {
                $tree[] = &$packData[$key];
            } else {
                $packData[$val[$pid]][$child][] = &$packData[$key];
            }
        }
        return $tree;
    }

    public function getUser(int $uid)
    {
        $user                 = $this->userData->getUser($uid);
        $userInfo             = $user[0];

        unset($userInfo['role_id']);

        $userInfo['role_ids'] = array_column($user, 'role_id');

        return $userInfo;
    }
}