<?php

namespace QCS\LaravelRbac\Models;

use QCS\LaravelApi\Models\BaseModel;

class UserRole extends BaseModel
{
    protected $table = 'user_roles';

    /**
     * 保存用户与角色之间的关联关系
     * @param int $userId 用户id
     * @param array $roleId 角色id
     * @return void
     */
    public function saveRelate(int $userId,array $roleIds){
        self::query()->where('user_id',$userId)->delete();

        foreach ($roleIds as $roleId){
            $data = [
                'user_id' => $userId,
                'role_id' => $roleId,
            ];

            self::query()->create($data);
        }
    }
}
