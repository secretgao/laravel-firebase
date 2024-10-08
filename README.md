代码笔试题
来源（https://github.com/gamesmama/game-docs/blob/main/Laravel-Interview.md）
运行操作流程

## 1.目录结构
```
/
├── logs                        日志目录
│   ├── nginx                  nginx 日志目录
│   └── php                    php 数据目录
├── services                    服务构建文件和配置文件目录
│   ├── nginx                   Nginx 配置文件目录
│   ├── php                      PHP7.4 配置目录
│   └── redis                   Redis 配置目录
├── www                         PHP 代码目录
├── auth                        笔试代码目录 （laravel5.8 firebase/php-jwt） 没用mysql，登录用户的帐号密码写死的

```
## 2.快速使用
### 1. 本地安装git 克隆本项目
   * 进入目录 执行  启动运行环境 nginx+php 容器
   ```
   docker-compose up -d  
   ```
#### 2. 在浏览器中访问：`http://localhost`就能看到效果，PHP代码在文件`./www/auth/*`。

## 3.实现流程
* 访问http://localhost，默认 laravel 项目首页 （忽略）
### 1.访问http://localhost/login ，项目登录页面 
* 用于登录的用户帐号密码 写死在html 页面的input value 里 
### 2.点击登录
*  通过 ajax POST 请求 {BASE_URL} /auth/v1/token  （详件项目路由文件），传入用户帐号和密码，返回 jwt的token ，并跳转到/home页面
### 3.点击home 页面的 profile 接口来获取用户信息
*  通过 ajax get 请求 GET {BASE_URL}/auth/v1/me  携带 bearerToken 通过jwt 解析用户信息
 
 
 ## 4.主要修改的代码目录结构
 ```
 
 ├── app                         
 │   ├── Http                   
 │   │   ├── Controller                     控制器目录
 │   │      ├── HomeController              home 控制器 登录之后跳转的
 │   │      ├── JwtController               jwt  控制器
 │   │      ├── LoginController             login 控制器
 │   │   ├── Middieware                     中间件目录
 │   │      ├── CheckJwtMiddleware.php         
 │   │      ├── JwtMiddleware.php              
 │   │   ├── Requests                       请求 rule 过滤
 │   │      ├── LoginRequest.php         
 │   ├── Services                   
 │   │   ├── JWTService.php                 jwt 相关 加密 解密 
 │   │   ├── UserService.php                登录用户的账号密码 写死在这个文件里 （ps ：没涉及到mysql）
 ├── routes                                 路由目录
 │   ├── web.php                            所有路由

 ```


