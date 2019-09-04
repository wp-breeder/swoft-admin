<?php declare(strict_types=1);


namespace App\Http\Controller;

use App\Helper\ReturnHelper;
use App\Model\Data\ResourceData;
use App\Model\Logic\ResourceLogic;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;

/**
 * 资源接口
 *
 * @Controller(prefix="/resource")
 */
class ResourceController
{
    /**
     * @Inject()
     * @var ResourceData
     */
    private $resourceData;

    /**
     * @Inject()
     * @var ResourceLogic
     */
    private $resourceLogic;

    /**
     * 获取所有资源信息
     * @RequestMapping(route="/resource", method={RequestMethod::GET}, params={"3","获取所有资源信息"})
     * @OA\Get(
     *     path="/resource",
     *     tags={"Resource"},
     *     summary="获取所有资源信息",
     *     operationId="getResources",
     *     security={
     *         {"token": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(ref="#/components/schemas/Resource")
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
    public function getResources()
    {
        $resources = $this->resourceData->getResources();

        return ReturnHelper::format('success', 200, $resources);
    }


    /**
     * 刷新资源
     * @RequestMapping(route="/resource", method={RequestMethod::PUT}, params={"3","刷新资源"})
     * @OA\Put(
     *     path="/resource",
     *     tags={"Resource"},
     *     summary="刷新资源",
     *     operationId="refreshResource",
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
     */
    public function refreshResource()
    {
        $ret = $this->resourceLogic->refresh();
        if ($ret) {
            return ReturnHelper::format('success', 200);
        } else {
            return ReturnHelper::format('failed', 500);
        }
    }
}