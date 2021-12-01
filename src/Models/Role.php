<?php

namespace QCS\LaravelRbac\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use QCS\LaravelApi\Models\BaseModel;

class Role extends BaseModel
{
    use SoftDeletes;

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Permission::class, RolePermission::class)->withPivot('is_half_select');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, UserRole::class);
    }
}
