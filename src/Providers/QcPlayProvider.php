<?php

namespace QCS\LaravelRbac\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use QCS\LaravelRbac\Controllers\PermissionController;
use QCS\LaravelRbac\Controllers\RoleController;

class QcPlayProvider extends ServiceProvider
{
    protected $configPath;
    protected $databasesPath;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //发布迁移文件
        $this->databasesPath = __DIR__ . '/../../database/migrations';

        $this->publishes([
            $this->databasesPath => database_path('migrations')
        ],'laravel-rbac');

        //注册路由
        $this->registerRoutes();
    }

    public function registerRoutes(): void
    {
        Route::group(['middleware' => ['api']], function ($router) {
            $router->apiResource('/api/roles', RoleController::class)->parameters(['roles' => 'id']);
            $router->apiResource('/api/permissions', PermissionController::class)->parameters(['permissions' => 'id']);

            $router->get('/api/roles_simple',[RoleController::class,'simple']);
            $router->get('/api/permissions_simple',[PermissionController::class,'simple']);
        });
    }
}
