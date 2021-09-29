<?php

namespace QCYX\LaravelRbac\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QCYX\LaravelApi\Models\BaseModel;

class RolePermission extends BaseModel
{
    use SoftDeletes;

    protected $table = 'role_permissions';
}
