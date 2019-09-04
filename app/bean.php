<?php

use App\Http\Middleware\ApiMiddleware;
use App\Http\Middleware\CorsMiddleware;
use App\Http\Middleware\IcoMiddleware;
use Swoft\Db\Database;
use Swoft\Http\Server\HttpServer;
use Swoft\Http\Server\Swoole\RequestListener;
use Swoft\Redis\RedisDb;
use Swoft\Server\SwooleEvent;
use Swoft\Task\Swoole\FinishListener;
use Swoft\Task\Swoole\TaskListener;
use Swoft\WebSocket\Server\WebSocketServer;

return [
    'logger'         => [
        'flushRequest' => true,
        'enable'       => false,
        'json'         => false,
    ],
    'httpServer'     => [
        'class'    => HttpServer::class,
        'port'     => 18306,
        'listener' => [
            'rpc' => bean('rpcServer')
        ],
        'on'       => [
            SwooleEvent::TASK   => bean(TaskListener::class),  // Enable task must task and finish event
            SwooleEvent::FINISH => bean(FinishListener::class)
        ],
        /* @see HttpServer::$setting */
        'setting'  => [
            'reactor_num'           => 4,
            'worker_num'            => 4,
            'task_worker_num'       => 12,
            'task_enable_coroutine' => true
        ]
    ],
    'httpDispatcher' => [
        // Add global http middleware
        'middlewares' => [
            // 跨域中间件
            CorsMiddleware::class,
            // ico 中间件，防止浏览器请求2次
            IcoMiddleware::class,
            // api 统一修改 http code
            ApiMiddleware::class,
        ],
    ],
    // 设置http 路由
    'httpRouter'     => [
        'ignoreLastSlash'    => false,
        'tmpCacheNumber'     => 1000,
        'matchAll'           => '',
        'currentGroupPrefix' => '/auth-service',
    ],
    'migrationManager' => [
        'migrationPath' => '@app/Model/Migration',
    ],
    'db'             => [
        'class'    => Database::class,
        'dsn'      => 'mysql:dbname=auth_service;host=172.17.0.1',
        'username' => 'root',
        'password' => '123456',
        'charset'  => 'utf8mb4',
        'prefix'   => 'sys_',
    ],
    'redis'          => [
        'class'    => RedisDb::class,
        'host'     => '172.17.0.1',
        'port'     => 6379,
        'database' => 0,
        'password' => 'test',
        'option'   => [
            'serializer' => Redis::SERIALIZER_PHP
        ],
    ],
    'wsServer'       => [
        'class'   => WebSocketServer::class,
        'on'      => [
            // Enable http handle
            SwooleEvent::REQUEST => bean(RequestListener::class),
        ],
        'debug'   => env('SWOFT_DEBUG', 0),
        /* @see WebSocketServer::$setting */
        'setting' => [
            'log_file' => alias('@runtime/swoole.log'),
        ],
    ],
];
