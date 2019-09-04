<?php

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="auth-service v1.0.0",
 *         title="SWOFT-ADMIN",
 *         description="**接口说明**<br/>
&nbsp;&nbsp;所有接口返回值均为`json`<br/><br/>
&nbsp;&nbsp;msg 提示信息;<br/>
&nbsp;&nbsp;data 请求的数据;<br/>
",
 *     ),
 *     @OA\Server(
 *          url="{schema}://{host}:{port}/{server-name}/",
 *          description="auth-service v1.0.0 接口地址",
 *          @OA\ServerVariable(
 *              serverVariable="schema",
 *              enum={"https", "http"},
 *              default="http"
 *          ),
 *          @OA\ServerVariable(
 *              serverVariable="host",
 *              default="192.168.23.57"
 *          ),
 *          @OA\ServerVariable(
 *              serverVariable="port",
 *              default="8004"
 *          ),
 *          @OA\ServerVariable(
 *              serverVariable="server-name",
 *              default="auth-service"
 *          ),
 *      )
 * ),
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="token",
 *     name="Authorization"
 * )
 */