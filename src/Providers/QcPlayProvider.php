<?php

namespace QCYX\LaravelRbac\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use QCYX\LaravelRbac\Controllers\PermissionController;
use QCYX\LaravelRbac\Controllers\RoleController;

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
        });
    }
}
