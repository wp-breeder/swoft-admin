<?php

/**
 * @OA\Tag(
 *     name="User",
 *     description="用户接口",
 * ),
 * @OA\Tag(
 *     name="Account",
 *     description="账号接口",
 * ),
 * @OA\Tag(
 *     name="Menu",
 *     description="菜单接口",
 * ),
 * @OA\Tag(
 *     name="Resource",
 *     description="资源接口",
 * ),
 * @OA\Tag(
 *     name="Role",
 *     description="角色接口",
 * ),
 *
 * @OA\Schema(
 *      schema="ReturnBody",
 *      required={"msg","data"},
 *      @OA\Property(
 *          property="msg",
 *          type="string",
 *          description="提示信息"
 *      ),
 *     @OA\Property(
 *          property="data",
 *          type="object",
 *          description="数据"
 *      ),
 *  )
 *
 */
