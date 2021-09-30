<?php

namespace QCS\LaravelRbac\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QCS\LaravelApi\Models\BaseModel;

class UserRole extends BaseModel
{
    use SoftDeletes;

    protected $table = 'user_role';
}
