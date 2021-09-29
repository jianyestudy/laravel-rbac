<?php

namespace QCYX\LaravelRbac\Controllers;

use Illuminate\Database\Eloquent\Builder;
use QCYX\LaravelApi\Controllers\BaseController;
use QCYX\LaravelApi\Traits\ResultTrait;
use QCYX\LaravelRbac\Models\Role;
use QCYX\LaravelRbac\Requests\RoleRequest;

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
