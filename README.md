## Swoft-Admin

### 说明
&nbsp;&nbsp;&nbsp;&nbsp;Sowft Admin 是使用Swoft实现的后台通用权限管理系统，本项目是一个示例项目，展示了swoft在平时开发中的一些常用的使用方法。

### 运行环境
- php 7.1 +
- Swoole 4.4.1 +
- Mysql 5.7 +
- Redis 3.2 +

### 功能列表

- 标准的Restful风格API;
- 防止XSS攻击、SQL注入;
- JWT鉴权，前后端完全隔离;
- 支持数据库版本迁移管理;
- 后续更多功能持续更新...

### 快速开始

- 修改前端请求API地址

```js
    // 配置文件地址 /path/to/project/web/dist/config.js
    window.api = {
        baseUri: '/auth-service/',
        // 修改为正确的IP地址
        serverHost: 'http://172.17.0.1',
        serverPort: 8004
    };
```

- 推荐使用`docker`运行本项目(摆脱复杂的环境安装), 克隆本项目，在项目根目录下运行`docker-compose up`即可;

> [docker 安装 ](https://github.com/wp-breeder/blogs/blob/master/doc/devOps.md#3-%E9%99%84%E5%BD%95)
```shell
    git clone https://github.com/wp-breeder/swoft-admin.git
    
    cd /path/to/project/ && docker-compose up
```

### 预览

![login](https://raw.githubusercontent.com/wp-breeder/blogs/master/_images/swoft-admin/login.png)
![dashboard](https://raw.githubusercontent.com/wp-breeder/blogs/master/_images/swoft-admin/dashboard.png)


### LICENSE

Swoft-Admin is open-sourced software licensed under the [Apache license](https://github.com/wp-breeder/swoft-admin/blob/master/LICENSE).