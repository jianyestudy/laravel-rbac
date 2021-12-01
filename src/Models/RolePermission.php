<?php

namespace QCS\LaravelRbac\Models;

use QCS\LaravelApi\Models\BaseModel;
use QCS\LaravelRbac\Interfaces\PermissionInterfaces;

class RolePermission extends BaseModel
{

    protected $table = 'role_permissions';

    /**
     * 保存角色与权限之间的关联关系
     * @param int $roleId 角色id
     * @param array $permissionId 权限id
     * @return void
     */
    public function saveRelate(int $roleId,array $permissionIds){
        self::query()->where('role_id',$roleId)->delete();

        foreach ($permissionIds as $item){

            $data = [
                'role_id' => $roleId,
                'permission_id' => $item,
//                'is_half_select' => $item['is_half_select']
            ];

            self::query()->create($data);
        }
    }
}
