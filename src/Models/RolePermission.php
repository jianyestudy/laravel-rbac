<?php

namespace QCS\LaravelRbac\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QCS\LaravelApi\Models\BaseModel;

class RolePermission extends BaseModel
{
    use SoftDeletes;

    protected $table = 'role_permissions';
}
