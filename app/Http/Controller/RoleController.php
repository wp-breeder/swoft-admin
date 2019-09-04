<?php declare(strict_types=1);


namespace App\Http\Controller;

use App\Exception\ApiException;
use App\Helper\ReturnHelper;
use App\Helper\TokenHelper;
use App\Http\Middleware\AuthMiddleware;
use App\Model\Data\RoleData;
use App\Model\Logic\RoleLogic;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Validator\Annotation\Mapping\Validate;
use function array_filter;

/**
 * 角色接口
 *
 * @Controller(prefix="/role")
 * @Middleware(AuthMiddleware::class)
 */
class RoleController
{
    /**
     * @Inject()
     * @var RoleData
     */
    private $roleData;

    /**
     * @Inject()
     * @var RoleLogic
     */
    private $roleLogic;

    /**
     * 获取所有角色信息
     * @RequestMapping(route="/role", method={RequestMethod::GET}, params={"3", "获取所有角色信息"})
     * @OA\Get(
     *     path="/role",
     *     tags={"Role"},
     *     summary="获取所有角色信息",
     *     operationId="getRoles",
     *     security={
     *         {"token": {}}
     *     },
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
     *                 property="menu_ids",
     *                 type="string",
     *                 description="角色对应菜单ID集合",
     *              ),
     *              @OA\Property(
     *                 property="role_id",
     *                 type="string",
     *                 description="角色ID",
     *              ),
     *              @OA\Property(
     *                 property="role_name",
     *                 type="string",
     *                 description="角色名称",
     *              ),
     *              @OA\Property(
     *                 property="create_uid",
     *                 type="string",
     *                 description="创建用户ID",
     *              ),
     *              @OA\Property(
     *                 property="update_uid",
     *                 type="string",
     *                 description="最后更新用户ID",
     *              ),
     *              @OA\Property(
     *                 property="create_time",
     *                 type="string",
     *                 description="创建时间",
     *              ),
     *              @OA\Property(
     *                 property="update_time",
     *                 type="string",
     *                 description="更新时间",
     *              ),
     *              @OA\Property(
     *                 property="remark",
     *                 type="string",
     *                 description="备注",
     *              ),
     *              example={"msg":"success","data":{{"role_id":1,"role_name":"测试","create_uid":1,"update_uid":1,"create_time":"2019-08-12 17:04:55","update_time":"2019-08-12 17:04:55","remark":"测试","menu_ids":{1,8,10,11,12}}}}
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
     */
    public function getRoles()
    {
        $roles = $this->roleLogic->getRoles();
        return ReturnHelper::format('success', 200, $roles);
    }

    /**
     * 获取指定角色信息
     * @RequestMapping(route="{roleId}", method={RequestMethod::GET}, params={"3", "获取指定角色信息"})
     * @OA\Get(
     *     path="/role/{role_id}",
     *     tags={"Role"},
     *     summary="获取指定角色信息",
     *     operationId="getRole",
     *     @OA\Parameter(
     *         name="role_id",
     *         in="path",
     *         description="角色唯一标识",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     *     security={
     *         {"token": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(ref="#/components/schemas/Role")
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
     * @param int $roleId
     * @return array
     * @throws ApiException
     */
    public function getRole(int $roleId)
    {
        $role = $this->roleData->getRole($roleId);
        if ($role) {
            return ReturnHelper::format('success', 200, $role);
        } else {
            throw new ApiException('role id error or not exists', 400);
        }
    }

    /**
     * 创建角色
     * @RequestMapping(route="/role", method={RequestMethod::POST}, params={"3", "创建角色"})
     * @Validate(validator="RoleValidator", fields={"roleName", "remark"})
     * @OA\Post(
     *     path="/role",
     *     tags={"Role"},
     *     summary="创建角色",
     *     operationId="createRole",
     *     security={
     *         {"token": {}},
     *     },
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  required={
     *                              "role_name",
     *                              "remark",
     *                          },
     *                  @OA\Property(
     *                      property="role_name",
     *                      type="string",
     *                      description="角色名称",
     *                  ),
     *                  @OA\Property(
     *                      property="remark",
     *                      type="string",
     *                      description="备注",
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
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function createRole(Request $request)
    {
        $roleInfo               = $request->post();
        $uid                    = TokenHelper::getUid($request);
        $roleInfo['create_uid'] = $uid;
        $roleInfo['update_uid'] = $uid;
        $ret                    = $this->roleData->createRole($roleInfo);
        if ($ret) {
            return ReturnHelper::format('success', 200, $ret);
        } else {
            return ReturnHelper::format('create failed', 400, $ret);
        }
    }

    /**
     * 更新角色信息
     * @RequestMapping(route="{roleId}", method={RequestMethod::PUT}, params={"3", "更新角色信息"})
     * @Validate(validator="RoleValidator", fields={"roleName", "remark"})
     * @OA\Put(
     *     path="/role/{role_id}",
     *     tags={"Role"},
     *     summary="更新角色信息",
     *     operationId="updateRole",
     *     security={
     *         {"token": {}},
     *     },
     *     @OA\Parameter(
     *         name="role_id",
     *         in="path",
     *         description="角色唯一标识",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="role_name",
     *                      type="string",
     *                      description="角色名称",
     *                  ),
     *                  @OA\Property(
     *                      property="remark",
     *                      type="string",
     *                      description="备注",
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
     *                 description="修改成功的角色ID",
     *              ),
     *              example={"msg":"success","data":1}
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
     * @param int $roleId
     * @return array
     * @throws ContainerException
     * @throws ReflectionException
     */
    public function updateRole(Request $request, int $roleId)
    {
        $roleInfo               = array_filter($request->post());
        $roleInfo['update_uid'] = TokenHelper::getUid($request);
        $ret                    = $this->roleData->updateRole($roleId, $roleInfo);
        if ($ret) {
            return ReturnHelper::format('success', 200, $ret);
        } else {
            return ReturnHelper::format('Role information update failed', 400, $ret);
        }
    }

    /**
     * 删除指定角色信息
     * @RequestMapping(route="{roleId}", method={RequestMethod::DELETE}, params={"3", "删除指定角色信息"})
     * @OA\Delete(
     *     path="/role/{role_id}",
     *     tags={"Role"},
     *     summary="删除指定角色信息",
     *     operationId="delRole",
     *     @OA\Parameter(
     *         name="role_id",
     *         in="path",
     *         description="角色唯一标识",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     *     security={
     *         {"token": {}},
     *     },
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
     *                 description="删除成功的角色ID",
     *              ),
     *              example={"msg":"success","data":1}
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
     * @param int $roleId
     * @return array
     * @throws ApiException
     */
    public function delRole(int $roleId)
    {
        $ret = $this->roleLogic->delRole($roleId);

        if ($ret) {
            return ReturnHelper::format('success', 200, $ret);
        } else {
            throw new ApiException('role information error or not exists', 400);
        }
    }

    /**
     * 修改角色菜单
     * @RequestMapping(route="{roleId}/menus", method={RequestMethod::PUT}, params={"3", "修改角色菜单"})
     * @OA\Put(
     *     path="/role/{role_id}/menus",
     *     tags={"Role"},
     *     summary="修改角色菜单",
     *     operationId="updateRoleMenus",
     *     security={
     *         {"token": {}},
     *     },
     *     @OA\Parameter(
     *         name="role_id",
     *         in="path",
     *         description="角色唯一标识",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="menu_ids",
     *                      type="array",
     *                      description="菜单集合 格式eg. id1,id2,id3",
     *                      @OA\Items(
     *                          type="integer",
     *                          format="int64",
     *                      ),
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
     *                 description="修改成功的角色ID",
     *              ),
     *              example={"msg":"success","data":1}
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
     * @param int $roleId
     * @return array
     */
    public function updateRoleMenus(Request $request, int $roleId)
    {
        $menuIds = $request->post('menu_ids');
        if (!$menuIds) {
            return ReturnHelper::format('menu id must be exists', 400);
        }

        $ret = $this->roleLogic->updateRoleMenuMapping($roleId, $menuIds);

        if ($ret) {
            return ReturnHelper::format('success', 200, $ret);
        } else {
            return ReturnHelper::format('role-menu-mapping created error', 400);
        }
    }
}