<?php

namespace QCS\LaravelRbac\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QCS\LaravelApi\Models\BaseModel;

class Role extends BaseModel
{
    use SoftDeletes;

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Permission::class, RolePermission::class);
    }
}
