<?php

namespace QCYX\LaravelRbac\Traits;

use Illuminate\Support\Collection;
use QCYX\LaravelRbac\Models\Role;
use QCYX\LaravelRbac\Models\UserRole;

/**
 * User: Edward Yu
 * Date: 2021/9/29
 * @method belongsToMany(string $class, string $class1)
 */
trait UserModelTrait
{
    public function roles(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Role::class, UserRole::class);
    }

    /**
     * 获取当前登录用户的角色权限集合
     * @Another Edward Yu 2021/9/29上午9:18
     * @param string $relationsRoleName 需传递用户表model与角色表之间的关联名称
     * @param string $relationsPermissionName 需传递角色表model与权限表之间的关联名称
     * @return Collection
     */

    public function getUserPermissions(string $relationsRoleName, string $relationsPermissionName) : Collection
    {
        //获取当前用户所有角色的权限
        $permissions = $this->{$relationsRoleName}->pluck((string)($relationsPermissionName))->flatten();
        //权限去重
        $notRepeat = $permissions->unique('id');

        //按照type排序
        return $notRepeat->sortBy('id')->values();
    }
}
