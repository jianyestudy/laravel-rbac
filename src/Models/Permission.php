<?php

namespace QCS\LaravelRbac\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QCS\LaravelApi\Models\BaseModel;

class Permission extends BaseModel
{
    use SoftDeletes;

    protected $table = 'menu_permissions';
}
