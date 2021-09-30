<?php

namespace QCS\LaravelRbac\Controllers;

use Illuminate\Database\Eloquent\Builder;
use QCS\LaravelApi\Controllers\BaseController;
use QCS\LaravelApi\Traits\ResultTrait;
use QCS\LaravelRbac\Models\Role;
use QCS\LaravelRbac\Requests\RoleRequest;

class RoleController extends BaseController
{
    use ResultTrait;

    public function __construct(Role $role, RoleRequest $request)
    {
        $this->model = $role;
        $this->request = $request;
    }

    public function indexSearch(Builder $builder, array $requestData) : void
    {
        if (!empty($requestData['keyword'])) {
            $keyword = $requestData['keyword'];
            $builder->where('name', 'like', "%$keyword%");
        }
    }
}
