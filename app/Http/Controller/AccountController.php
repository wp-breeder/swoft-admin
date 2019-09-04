<?php


namespace App\Http\Controller;

use App\Bean\AuthSession;
use App\Exception\AuthException;
use App\Helper\ReturnHelper;
use App\Helper\TokenHelper;
use App\Http\Middleware\AuthMiddleware;
use App\Model\Logic\AccountLogic;
use App\Model\Logic\AuthManagerLogic;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Validator\Annotation\Mapping\Validate;
use function Bean;

/**
 * Class AccountController
 * @Controller(prefix="/account")
 */
class AccountController
{

    /**
     * @Inject()
     * @var AccountLogic
     */
    protected $accountLogic;

    /**
     * 账号登录
     * @RequestMapping(route="token", method={RequestMethod::POST}, params={"2", "账号登录"})
     * @Validate(validator="UserValidator", fields={"loginName", "password"})
     * @OA\Post(
     *     path="/account/token",
     *     tags={"Account"},
     *     summary="账号登录",
     *     operationId="genToken",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  required={
     *                              "identity",
     *                              "credential",
     *                          },
     *                  @OA\Property(
     *                      property="identity",
     *                      type="string",
     *                      description="用户登录名/手机号/邮箱地址",
     *                  ),
     *                  @OA\Property(
     *                      property="credential",
     *                      type="string",
     *                      format="password",
     *                      description="用户登录密码",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="string",
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 description="鉴权token",
     *              ),
     *             @OA\Property(
     *                 property="expire",
     *                 type="string",
     *                 description="token 过期时间",
     *              ),
     *              example={"msg":"success","data":{"token":"token_info","expire":1562654876}}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param Request $request
     * @return array
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function genToken(Request $request): array
    {
        $logInfo = $request->post();
        if (!isset($logInfo['identity']) || !isset($logInfo['credential'])) {
            return ReturnHelper::format('identity and credential are must be', 400);
        }

        $manager = Bean(AuthManagerLogic::class);
        /** @var AuthSession $session */
        $session = $manager->adminBasicLogin($logInfo['identity'], $logInfo['credential']);
        $data    = [
            'token'  => $session->getToken(),
            'expire' => $session->getExpirationTime()
        ];
        return ReturnHelper::format('success', 200, $data);
    }

    /**
     * 刷新token
     * @RequestMapping(route="refresh", method={RequestMethod::GET}, params={"1", "刷新token"})
     * @Middleware(AuthMiddleware::class)
     * @OA\Get(
     *     path="/account/refresh",
     *     tags={"Account"},
     *     summary="刷新token",
     *     operationId="refresh",
     *     security={
     *          {"token": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="string",
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 description="鉴权token",
     *              ),
     *             @OA\Property(
     *                 property="expire",
     *                 type="string",
     *                 description="token 过期时间",
     *              ),
     *              example={"msg":"success","data":{"token":"token_info","expire":1562654876}}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param Request $request
     * @return array
     * @throws ContainerException
     * @throws AuthException
     * @throws ReflectionException
     */
    public function refresh(Request $request)
    {
        $token = TokenHelper::getToken($request);
        /** @var AuthSession $session */
        $session = $this->accountLogic->refreshToken($token);

        $data = [
            'token'  => $session->getToken(),
            'expire' => $session->getExpirationTime()
        ];

        return ReturnHelper::format('success', 200, $data);
    }

    /**
     * 退出登录
     * @RequestMapping(route="logout", method={RequestMethod::GET}, params={"1", "退出登录"})
     * @Middleware(AuthMiddleware::class)
     * @OA\Get(
     *     path="/account/logout",
     *     tags={"Account"},
     *     summary="退出登录",
     *     operationId="logout",
     *     security={
     *          {"token": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *          @OA\JsonContent(
     *             type="string",
     *             @OA\Property(
     *                 property="msg",
     *                 type="string",
     *                 description="提示信息",
     *              ),
     *             @OA\Property(
     *                 property="data",
     *                 type="string",
     *                 description="返回数据",
     *              ),
     *              example={"msg":"success","data":{}}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param Request $request
     * @return array
     * @throws AuthException
     */
    public function logout(Request $request)
    {
        $token = TokenHelper::getToken($request);
        /** @var AuthSession $session */
        $this->accountLogic->delToken($token);

        return ReturnHelper::format('success', 200);
    }

    /**
     * 获取账号详细信息
     * @RequestMapping(route="info", method={RequestMethod::GET}, params={"1", "获取账号详细信息"})
     * @Middleware(AuthMiddleware::class)
     * @OA\Get(
     *     path="/account/info",
     *     tags={"Account"},
     *     summary="获取账号详细信息",
     *     operationId="getAccount",
     *     security={
     *          {"token": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param Request $request
     * @return array
     */
    public function getAccount(Request $request)
    {
        $token = TokenHelper::getToken($request);
        $user  = $this->accountLogic->getAccount($token);

        return ReturnHelper::format('success', 200, $user);
    }

    /**
     * 修改账号信息
     * @RequestMapping(route="info", method={RequestMethod::PUT}, params={"1", "修改账号信息"})
     * @Middleware(AuthMiddleware::class)
     * @Validate(validator="UserValidator", fields={"nickname", "email", "phone"})
     * @OA\Put(
     *     path="/account/info",
     *     tags={"Account"},
     *     summary="修改账号信息",
     *     operationId="editAccount",
     *     security={
     *         {"token": {}},
     *     },
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="nickname",
     *                      type="string",
     *                      description="用户昵称",
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      format="email",
     *                      description="用户邮箱",
     *                  ),
     *                  @OA\Property(
     *                      property="phone",
     *                      type="string",
     *                      description="用户手机",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="string",
     *             @OA\Property(
     *                 property="msg",
     *                 type="string",
     *                 description="提示信息",
     *              ),
     *             @OA\Property(
     *                 property="data",
     *                 type="string",
     *                 description="true为修改成功",
     *              ),
     *              example={"msg":"success","data":true}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param Request $request
     * @return array
     */
    public function editAccount(Request $request)
    {
        $accountInfo = $request->post();
        $token       = TokenHelper::getToken($request);

        $ret = (bool)$this->accountLogic->editAccount($accountInfo, $token);

        if ($ret) {
            return ReturnHelper::format('success', 200, $ret);
        } else {
            return ReturnHelper::format('edit error, please check params', 400, $ret);
        }

    }

    /**
     * 修改密码
     * @RequestMapping(route="password", method={RequestMethod::PUT}, params={"1", "修改密码"})
     * @Middleware(AuthMiddleware::class)
     * @OA\Put(
     *     path="/account/password",
     *     tags={"Account"},
     *     summary="修改密码",
     *     operationId="editPwd",
     *     security={
     *         {"token": {}},
     *     },
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  required={
     *                              "credential",
     *                          },
     *                  @OA\Property(
     *                      property="credential",
     *                      type="string",
     *                      format="password",
     *                      description="用户新密码",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="string",
     *             @OA\Property(
     *                 property="msg",
     *                 type="string",
     *                 description="提示信息",
     *              ),
     *             @OA\Property(
     *                 property="data",
     *                 type="string",
     *                 description="true为创建成功",
     *              ),
     *              example={"msg":"success","data":true}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param Request $request
     * @return array
     * @throws AuthException
     */
    public function editPwd(Request $request)
    {
        $token      = TokenHelper::getToken($request);
        $credential = $request->post();

        $ret = $this->accountLogic->editPwd($credential, $token);

        return ReturnHelper::format('success', 200, $ret);
    }

    /**
     * 获取账号菜单
     * @RequestMapping(route="menu", method={RequestMethod::GET}, params={"1", "获取账号菜单"})
     * @Middleware(AuthMiddleware::class)
     * @OA\Get(
     *     path="/account/menu",
     *     tags={"Account"},
     *     summary="获取账号菜单",
     *     operationId="getMenusByUid",
     *     security={
     *          {"token": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="string",
     *             @OA\Property(
     *                 property="menu_id",
     *                 type="integer",
     *                 description="菜单ID",
     *             ),
     *             @OA\Property(
     *                 property="alias",
     *                 type="string",
     *                 description="菜单别名",
     *             ),
     *             @OA\Property(
     *                 property="parent_id",
     *                 type="integer",
     *                 description="父菜单ID",
     *             ),
     *             @OA\Property(
     *                 property="menu_name",
     *                 type="string",
     *                 description="菜单名称",
     *             ),
     *             @OA\Property(
     *                 property="path",
     *                 type="string",
     *                 description="菜单路由",
     *             ),
     *             @OA\Property(
     *                 property="menu_type",
     *                 type="integer",
     *                 description="菜单类型 0:目录 1:菜单 2:按钮",
     *              ),
     *             @OA\Property(
     *                 property="icon",
     *                 type="string",
     *                 description="菜单图标",
     *             ),
     *              example={"msg":"success","data":{{"menu_id":1,"alias":"","parent_id":0,"menu_name":"系统管理","path":"","menu_type":1,"icon":"layui-icon-set","children":{{"menu_id":8,"alias":"sys:user:list","parent_id":1,"menu_name":"用户管理","path":"views/user/index.html","menu_type":2,"icon":"layui-icon-username"},{"menu_id":9,"alias":"sys:role:list","parent_id":1,"menu_name":"角色管理","path":"views/role/index.html","menu_type":2,"icon":"layui-icon-face-surprised"}}}}}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param Request $request
     * @return array
     * @throws ContainerException
     * @throws ReflectionException
     */
    public function getMenusByUid(Request $request)
    {
        $uid = TokenHelper::getUid($request);
        $menus = $this->accountLogic->getMenus($uid);
        return ReturnHelper::format('success', 200, $menus);
    }

    /**
     * 获取账号所有按钮信息
     * @RequestMapping(route="button", method={RequestMethod::GET}, params={"1", "获取账号菜单"})
     * @Middleware(AuthMiddleware::class)
     * @OA\Get(
     *     path="/account/button",
     *     tags={"Account"},
     *     summary="获取账号所有按钮信息",
     *     operationId="getButtons",
     *     security={
     *          {"token": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="string",
     *             @OA\Property(
     *                 property="data",
     *                 type="string",
     *                 description="按钮别名列表",
     *              ),
     *              example={"msg":"success","data":{"sys:user:list","sys:role:list"}}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param Request $request
     * @return array
     * @throws ContainerException
     * @throws ReflectionException
     */
    public function getButtons(Request $request)
    {
        $uid = TokenHelper::getUid($request);
        $ret = $this->accountLogic->getButtons($uid);

        return ReturnHelper::format('success', 200, $ret);
    }
}