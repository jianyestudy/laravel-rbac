**基于Laravel设计的Restful风格rbac三方包，该包依赖laravel-api扩展包 安装前请先安装qcs/laravel-api**


##### 安装说明：

1. composer require qcs/laravel-rbac
2. 发布迁移文件，路由等：php artisan vendor:publish --provider="QCS\LaravelRbac\Providers\QcPlayProvider"
3. laravel5.5以下 在config/app.php文件provides 中添加\QCS\LaravelRbac\Providers\QcPlayProvider::class, ，laravel5.5以上自动发现
4.发布迁移：php atisan migrate
5.在UserModel中添加UserModelTrait 
6.判断权限时 使用CheckUserPermission 中间件
```


