<?php

namespace QCYX\LaravelRbac\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QCYX\LaravelApi\Models\BaseModel;

class Permission extends BaseModel
{
    use SoftDeletes;
}
