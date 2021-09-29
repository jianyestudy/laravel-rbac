<?php

namespace QCYX\LaravelRbac\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use QCYX\LaravelApi\Exceptions\ResultException;
use QCYX\LaravelApi\Interfaces\ResultCodeInterface;
use QCYX\LaravelApi\Interfaces\ResultMsgInterface;
use QCYX\LaravelApi\Traits\ResultTrait;

class CheckUserPermission
{
    use ResultTrait;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws ResultException
     */
    public function handle(Request $request, Closure $next)
    {
        //判断是否有已登录的用户实例
        if (empty($request->user())) {
            $this->error('暂无用户登录信息');
        }
        //获取用户角色权限集合
        $permissions = $request->user()->getUserPermissions('roles', 'permissions');

        //无任何权限
        if ($permissions->isEmpty()) {
            $this->error('未分配角色或权限', ResultCodeInterface::NO_PERMISSION);
        }

        //请求路由别名与权限判断
        $routeName = Route::currentRouteName();
        $routeNames = $permissions->pluck('route_name');
        if (!$routeName) {
            $this->error(ResultMsgInterface::SYS_EXCEPTION_MSG);
        }

        //验证对应权限
        if(!$routeNames->search($routeName)){
            $this->error(ResultMsgInterface::INVALID_REQUEST_MSG, ResultCodeInterface::NO_PERMISSION);
        }

        return $next($request);
    }
}
