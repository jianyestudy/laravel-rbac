<?php

namespace QCYX\LaravelRbac\Requests;

use Illuminate\Validation\Rule;
use QCYX\LaravelApi\Validates\BaseValidate;

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
            'id' => ['bail', 'required', 'numeric', Rule::exists('permissions', 'id')->whereNull('deleted_at')],
            'pid' => ['bail', 'numeric','nullable', Rule::exists('permissions', 'id')->whereNull('deleted_at')],
            'title' => ['bail', 'string', 'max:20'],
            'name' => ['bail', 'string', 'max:50'],
            'view_router_name' => ['bail', 'string', 'max:50'],
            'view_router_path' => ['bail', 'string', 'max:50'],
            'is_menu' => ['bail', 'numeric', 'boolean'],
            'is_hidden' => ['bail', 'numeric', 'boolean'],
            'weight' => ['bail', 'numeric'],
            'icon' => ['bail', 'string', 'max:20'],

            'type' => ['bail', 'nullable','string', Rule::in(['all', 'page'])],
            'limit' => ['bail', 'nullable', 'numeric', 'max:10000'],
            'page' => ['bail', 'nullable','numeric'],
            'keyword' => ['bail','nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'pid' => '父级',
            'title' => '权限名',
            'name' => '后端路由标识',
            'view_router_name' => '前端模块名',
            'view_router_path' => '前端路由标识',
            'is_menu' => '是否是菜单',
            'is_hidden' => '是否隐藏',
            'weight' => '权重',
            'type' => '分页类型',
            'limit' => '条数',
            'page' => '页码',
            'keyword' => '关键词',
        ];
    }

    public function indexCheck(array $data): array
    {
        return $this->scene($data, $this->many(['type', 'limit', 'page', 'keyword', 'pid']));
    }

    public function storeCheck(array $data): array
    {
        return $this->scene($data, $this->many(['pid', 'title', 'name', 'view_router_name', 'view_router_path', 'is_menu', 'is_hidden', 'weight']));
    }

    public function showCheck(array $data): array
    {
        return $this->scene($data, $this->many(['id']));

    }

    public function updateCheck(array $data):array
    {
        return $this->scene($data, $this->many(['id', 'name', 'title', 'pid', 'view_router_name', 'view_router_path', 'is_menu', 'is_hidden', 'weight']));
    }

    public function destroyCheck(array $data):array
    {
        return $this->scene($data, $this->many(['id']));
    }
}
