<?php

namespace QCYX\LaravelRbac\Requests;

use Illuminate\Validation\Rule;
use QCYX\LaravelApi\Validates\BaseValidate;

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
            'id' => ['bail', 'required', 'numeric', Rule::exists('roles', 'id')->whereNull('deleted_at')],
            'pid' => ['bail', 'numeric','nullable', Rule::exists('roles', 'id')->whereNull('deleted_at')],
            'name' => ['bail', 'string', 'max:20', 'unique:roles,name', 'required'],
            'remark' => ['bail', 'string', 'max:50'],

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
            'name' => '角色名',
            'remark' => '备注',
            'type' => '分页类型',
            'limit' => '条数',
            'page' => '页码',
            'keyword' => '角色名',
        ];
    }

    public function indexCheck(array $data): array
    {
        return $this->scene($data, $this->many(['type', 'limit', 'page', 'keyword', 'pid']));
    }

    public function storeCheck(array $data): array
    {
        return $this->scene($data, $this->many(['name', 'remark', 'pid']));
    }

    public function showCheck(array $data): array
    {
        return $this->scene($data, $this->many(['id']));
    }

    public function updateCheck(array $data):array
    {
        return $this->scene($data, $this->many(['id', 'name', 'remark', 'pid']));
    }
}
