<?php

namespace QCYX\LaravelRbac\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QCYX\LaravelApi\Models\BaseModel;

class Role extends BaseModel
{
    use SoftDeletes;
}
