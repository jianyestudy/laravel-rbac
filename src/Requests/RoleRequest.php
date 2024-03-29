<?php

namespace QCS\LaravelRbac\Requests;

use Illuminate\Validation\Rule;
use QCS\LaravelApi\Validates\BaseValidate;
use QCS\LaravelRbac\Interfaces\RoleStatusInterface;
use QCS\LaravelRbac\Models\Role;

class RoleRequest extends BaseValidate
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'     => ['bail', 'required', 'numeric', Rule::exists(Role::class, 'id')->whereNull('deleted_at')],
            'name'   => ['bail', 'string', 'unique:roles,name,'.$this->route('id'), 'required'],
            'flag'   => ['bail', 'string', 'max:20', 'required'],
            'status' => ['bail', 'numeric', Rule::in(array_keys(RoleStatusInterface::MSG))],
            'sort'   => ['bail', 'numeric'],
            'remark' => ['bail', 'string', 'max:50'],
            'permission_ids' => ['bail', 'required' ,'json'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'      => '角色名',
            'status'    => '角色状态',
            'flag'      => '角色标识',
            'sort'      => '排序',
            'remark'    => '备注',
            'permission_ids' => '权限id'
        ];
    }

    public function indexValidate(): array
    {
        return $this->scene($this->autoTake(), true);
    }

    public function storeValidate(): array
    {
        return $this->scene($this->take(['name', 'permission_ids' ,'remark', 'flag', 'status', 'sort']));
    }

    public function showValidate(): array
    {
        return $this->scene($this->take(['id']));
    }

    public function updateValidate():array
    {
        return $this->scene($this->autoTake());
    }

    public function destroyValidate():array
    {
        return $this->scene($this->take(['id']));
    }
}
