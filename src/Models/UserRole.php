<?php

namespace QCYX\LaravelRbac\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QCYX\LaravelApi\Models\BaseModel;

class UserRole extends BaseModel
{
    use SoftDeletes;

    protected $table = 'user_role';
}
