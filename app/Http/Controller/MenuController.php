<?php declare(strict_types=1);


namespace App\Http\Controller;

use App\Exception\ApiException;
use App\Helper\ReturnHelper;
use App\Helper\TokenHelper;
use App\Http\Middleware\AuthMiddleware;
use App\Model\Data\MenuData;
use App\Model\Logic\MenuLogic;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Validator\Annotation\Mapping\Validate;
use Swoft\Validator\Annotation\Mapping\ValidateType;
use function array_filter;

/**
 * 菜单接口
 *
 * @Controller(prefix="/menu")
 * @Middleware(AuthMiddleware::class)
 */
class MenuController
{

    /**
     * @Inject()
     * @var MenuData
     */
    private $menuData;

    /**
     * @Inject()
     * @var MenuLogic
     */
    private $menuLogic;

    /**
     * 获取所有菜单列表
     * @RequestMapping(route="/menu", method={RequestMethod::GET}, params={"3", "获取所有菜单列表"})
     * @OA\Get(
     *     path="/menu",
     *     tags={"Menu"},
     *     summary="获取所有菜单列表",
     *     operationId="getMeans",
     *     security={
     *         {"token": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(ref="#/components/schemas/Menu")
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
    public function getMenus()
    {
        $menus = $this->menuLogic->getMenus();

        return ReturnHelper::format('success', 200, $menus);
    }

    /**
     * 获取指定菜单列表
     * @RequestMapping(route="{menuId}", method={RequestMethod::GET}, params={"3", "获取指定菜单列表"})
     * @OA\Get(
     *     path="/menu/{menu_id}",
     *     tags={"Menu"},
     *     summary="获取指定菜单列表",
     *     operationId="getMean",
     *     @OA\Parameter(
     *         name="menu_id",
     *         in="path",
     *         description="菜单唯一标识",
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
     *         @OA\JsonContent(ref="#/components/schemas/Menu")
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
     * @param int $menuId
     * @return array
     * @throws ApiException
     */
    public function getMenu(int $menuId)
    {
        $menu = $this->menuData->getMenu($menuId);
        if ($menu) {
            return ReturnHelper::format('success', 200, $menu);
        } else {
            throw new ApiException('menu id error or not exists', 400);
        }
    }

    /**
     * 创建菜单
     * @RequestMapping(route="/menu", method={RequestMethod::POST}, params={"3", "创建菜单"})
     * @Validate(validator="MenuValidator", fields={"menuName","menuType", "icon"})
     * @OA\Post(
     *     path="/meun",
     *     tags={"Menu"},
     *     summary="创建菜单",
     *     operationId="createMean",
     *     security={
     *         {"token": {}},
     *     },
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  required={
     *                              "parent_id",
     *                              "menu_name",
     *                              "menu_type",
     *                              "icon",
     *                          },
     *                  @OA\Property(
     *                      property="parent_id",
     *                      type="string",
     *                      description="菜单所属父级",
     *                  ),
     *                  @OA\Property(
     *                      property="menu_name",
     *                      type="string",
     *                      description="菜单名称",
     *                  ),
     *                  @OA\Property(
     *                      property="path",
     *                      type="string",
     *                      description="菜单路由",
     *                  ),
     *                  @OA\Property(
     *                      property="menu_type",
     *                      type="integer",
     *                      description="菜单类型(类型 0:目录 1:菜单 2:按钮)",
     *                      enum = {0, 1, 2},
     *                  ),
     *                  @OA\Property(
     *                      property="status",
     *                      type="integer",
     *                      description="菜单状态(类型 0:禁用 1:正常)",
     *                      enum = {0, 1},
     *                  ),
     *                  @OA\Property(
     *                      property="resource_ids",
     *                      type="array",
     *                      description="资源id集合 格式eg. id1,id2,id3",
     *                      @OA\Items(
     *                          type="string",
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="icon",
     *                      type="string",
     *                      description="菜单图标",
     *                  ),
     *                  @OA\Property(
     *                      property="router",
     *                      type="string",
     *                      description="菜单路由",
     *                  ),
     *                  @OA\Property(
     *                      property="alias",
     *                      type="string",
     *                      description="菜单别名",
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
     * @throws ApiException
     * @throws ContainerException
     * @throws ReflectionException
     */
    public function createMenu(Request $request)
    {
        $menuInfo               = $request->post();
        $menuInfo['create_uid'] = TokenHelper::getUid($request);
        $menuInfo['update_uid'] = $menuInfo['create_uid'];

        $ret = $this->menuLogic->createMenu($menuInfo);

        if ($ret) {
            return ReturnHelper::format('success', 200, $ret);
        } else {
            throw new ApiException('menu params error', 400);
        }
    }

    /**
     * 删除指定菜单
     * @RequestMapping(route="{menuId}", method={RequestMethod::DELETE}, params={"3", "删除指定菜单"})
     * @OA\Delete(
     *     path="/menu/{menu_id}",
     *     tags={"Menu"},
     *     summary="删除指定菜单",
     *     operationId="delMenu",
     *     @OA\Parameter(
     *         name="menu_id",
     *         in="path",
     *         description="菜单唯一标识",
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
     *                 description="删除成功的菜单ID",
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
     * @param int $menuId
     * @return array
     * @throws ApiException
     */
    public function delMenu(int $menuId)
    {
        $ret = $this->menuLogic->delMenu($menuId);
        if ($ret) {
            return ReturnHelper::format('success', 200, $ret);
        } else {
            throw new ApiException('menu id error or not exists', 400);
        }
    }

    /**
     * 更新指定菜单
     * @RequestMapping(route="{menuId}", method={RequestMethod::PUT}, params={"3", "更新指定菜单"})
     * @OA\Put(
     *     path="/menu/{menu_id}",
     *     tags={"Menu"},
     *     summary="更新指定菜单",
     *     operationId="updateMenu",
     *     @OA\Parameter(
     *         name="menu_id",
     *         in="path",
     *         description="菜单唯一标识",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     *     security={
     *         {"token": {}},
     *     },
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="parent_id",
     *                      type="string",
     *                      description="菜单所属父级",
     *                  ),
     *                  @OA\Property(
     *                      property="menu_name",
     *                      type="string",
     *                      description="菜单名称",
     *                  ),
     *                  @OA\Property(
     *                      property="resource_ids",
     *                      type="array",
     *                      description="资源id集合 格式eg. id1,id2,id3",
     *                      @OA\Items(
     *                          type="string",
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="path",
     *                      type="string",
     *                      description="菜单路由",
     *                  ),
     *                  @OA\Property(
     *                      property="menu_type",
     *                      type="integer",
     *                      description="菜单类型(类型 0:目录 1:菜单 2:按钮)",
     *                      enum = {0, 1, 2},
     *                  ),
     *                  @OA\Property(
     *                      property="icon",
     *                      type="string",
     *                      description="菜单图标",
     *                  ),
     *                  @OA\Property(
     *                      property="router",
     *                      type="string",
     *                      description="菜单路由",
     *                  ),
     *                  @OA\Property(
     *                      property="alias",
     *                      type="string",
     *                      description="菜单别名",
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
     *                 description="更新成功的菜单ID",
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
     * @param int $menuId
     * @return array
     * @throws ApiException
     * @throws ContainerException
     * @throws ReflectionException
     */
    public function updateMenu(Request $request, int $menuId)
    {
        $menuInfo               = array_filter($request->post());
        $menuInfo['update_uid'] = TokenHelper::getUid($request);

        $ret = $this->menuLogic->updateMenu($menuId, $menuInfo);

        if ($ret) {
            return ReturnHelper::format('success', 200, $ret);
        } else {
            throw new ApiException('menu params error', 400);
        }
    }

    /**
     * 设置指定菜单状态
     * @RequestMapping(route="{menuId}/status", method={RequestMethod::PUT}, params={"3", "更新指定菜单"})
     * @Validate(validator="MenuValidator", fields={"status"}, type=ValidateType::GET)
     * @OA\Put(
     *     path="/menu/{menu_id}/status",
     *     tags={"Menu"},
     *     summary="设置指定菜单状态",
     *     operationId="setMenuStatus",
     *     @OA\Parameter(
     *         name="menu_id",
     *         in="path",
     *         description="菜单唯一标识",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="菜单状态信息0:禁用 1:正常",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             enum = {0, 1},
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
     *                 description="修改成功的菜单ID",
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
     * @param int $menuId
     * @return array
     * @throws ApiException
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function setMenuStatus(Request $request, int $menuId)
    {
        $menuInfo['status']     = (int)$request->query('status');
        $menuInfo['update_uid'] = TokenHelper::getUid($request);

        $ret = $this->menuData->updateMenu($menuId, $menuInfo);
        if ($ret) {
            return ReturnHelper::format('success', 200, $ret);
        } else {
            throw new ApiException('menu id error or status error', 400);
        }

    }

    /**
     * 获取菜单列表(目录、菜单)
     * @RequestMapping(route="list", method={RequestMethod::GET}, params={"3", "获取菜单列表(目录、菜单)"})
     * @OA\Get(
     *     path="/menu/list",
     *     tags={"Menu"},
     *     summary="获取菜单列表(目录、菜单)",
     *     operationId="getMenuList",
     *     security={
     *         {"token": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(ref="#/components/schemas/Menu")
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
    public function getMenuList()
    {
        $menuList = $this->menuData->getMenuList();

        return ReturnHelper::format('success', 200, $menuList);
    }
}