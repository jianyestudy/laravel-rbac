<?php

namespace QCS\LaravelRbac\Requests;

use Illuminate\Validation\Rule;
use QCS\LaravelApi\Validates\BaseValidate;
use QCS\LaravelRbac\Interfaces\PermissionInterfaces;

class PermissionRequest extends BaseValidate
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'                => ['bail', 'required', 'numeric', Rule::exists('menu_permissions', 'id')->whereNull('deleted_at')],
            'parent_id'         => ['bail', 'numeric',  'nullable', Rule::exists('menu_permissions', 'id')->whereNull('deleted_at')],
            'name'              => ['bail', 'string', 'max:20', 'required'],
            'route_name'        => ['bail', 'string', 'nullable', 'max:100'],
            'view_route_name'   => ['bail', 'string', 'max:50', 'nullable'],
            'view_route_path'   => ['bail', 'string', 'max:50', 'nullable'],
            'menu_type'         => ['bail', 'numeric', Rule::in(array_keys(PermissionInterfaces::TYPE_MSG))],
            'is_hidden'         => ['bail', 'required', Rule::in(array_keys(PermissionInterfaces::HIDDEN_MSG))],
            'sort'              => ['bail', 'numeric'],
            'icon'              => ['bail', 'string', 'max:20'],
        ];
    }

    public function attributes(): array
    {
        return [
            'parent_id'          => '父级id',
            'name'               => '菜单权限名',
            'route_name'         => '后端路由标识',
            'view_route_name'    => '前端模块名',
            'view_route_path'    => '前端路径',
            'menu_type'          => '菜单类型',
            'is_hidden'          => '是否隐藏',
            'sort'               => '排序',
            'icon'               => '菜单图标'
        ];
    }

    public function indexValidate(): array
    {
        return $this->scene([],true);
    }

    public function storeValidate(): array
    {
        return $this->scene($this->take([
            'parent_id',
            'name',
            'menu_type',
            'route_name',
            'view_route_name',
            'view_router_path',
            'is_hidden',
            'sort',
            'icon'
        ]));
    }

    public function showValidate(): array
    {
        return $this->scene($this->take(['id']));
    }

    public function updateValidate(): array
    {
        return $this->scene($this->autoTake());
    }

    public function destroyValidate(): array
    {
        return $this->scene($this->take(['id']));
    }
}
