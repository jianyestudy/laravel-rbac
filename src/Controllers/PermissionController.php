<?php

namespace QCS\LaravelRbac\Controllers;

use Illuminate\Database\Eloquent\Builder;
use QCS\LaravelApi\Controllers\BaseController;
use QCS\LaravelApi\Traits\ResultTrait;
use QCS\LaravelRbac\Models\Permission;
use QCS\LaravelRbac\Requests\PermissionRequest;

class PermissionController extends BaseController
{
    use ResultTrait;
    public function __construct(PermissionRequest $request, Permission $model)
    {
        $this->request = $request;
        $this->model   = $model;
    }

    /**
     * 按名称筛选
     * @param Builder $builder
     * @param array $requestData
     * @Another Edward Yu 2021/9/27下午8:24
     */
    public function indexSearch(Builder $builder, array  $requestData):void
    {
        if ( !empty($requestData['keyword']) ) {
            $keyword = $requestData['keyword'];
            $builder->where('name', 'like', "%$keyword%");
        }
    }
}
