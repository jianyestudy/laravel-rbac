<?php

namespace QCS\LaravelRbac\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use QCS\LaravelApi\Controllers\BaseController;
use QCS\LaravelApi\Exceptions\ResultException;
use QCS\LaravelApi\Traits\ResultTrait;
use QCS\LaravelRbac\Models\Role;
use QCS\LaravelRbac\Models\RolePermission;
use QCS\LaravelRbac\Requests\RoleRequest;

class RoleController extends BaseController
{
    use ResultTrait;

    protected $rolePermissionModel;

    public function __construct(Role $role,RolePermission $rolePermission,RoleRequest $request)
    {
        $this->model = $role;
        $this->rolePermissionModel = $rolePermission;
        $this->request = $request;
    }

    /**
     * @throws ResultException
     */
    public function simple(){
        $builder = $this->model->query();

        if(request()->keyword){
            $builder->where('name','like',request()->keyword);
        }

        $result = $builder->select('id','name')->get();

        $this->success($result);
    }

    public function indexSearch(Builder $builder, array $requestData) : void
    {
        if (!empty($requestData['keyword'])) {
            $keyword = $requestData['keyword'];
            $builder->where('name', 'like', "%$keyword%");
        }
    }

    public function withShowBuilder(Builder $builder, array $requestData) : void
    {
        $builder->with('permissions');
    }

    public function showAfterHandler($result): void
    {
//        foreach ($result->permissions as $key => $permission){
//            $result->permissions[$key]['is_half_select'] = $permission->pivot->is_half_select;
//
//            unset($result->permissions[$key]['pivot']);
//        }
    }

    public function store(): void
    {
        // 新增前置 返回验证过的数据
        $requestData = $this->storeBeforeHandler();
        $permissionIds = json_decode($requestData['permission_ids'],true) ;
        unset($requestData['permission_ids']);
        $requestData['sort'] = 1;
        $requestData['remark'] = '哈哈';

        //构造器
        $builder = $this->model::query();

        DB::beginTransaction();
        try{
            $role = $builder->create($requestData);

            $this->rolePermissionModel->saveRelate($role->id,$permissionIds);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::debug('新增角色失败：'. $e->getFile().'|'.$e->getLine().'|'.$e->getMessage());
            $this->error('新增角色失败');
        }

        $this->success($role->id);
    }

    /**
     * update 更新
     * @throws ResultException
     */
    public function update(int $id): void
    {
        //更新前置操作
        $requestData = $this->updateBeforeHandler();

        $role = $this->model::query()->find($id);

        DB::beginTransaction();
        try{
            if(isset($requestData['permission_ids'])){
                $this->rolePermissionModel->saveRelate($role->id,json_decode($requestData['permission_ids'],true));
                unset($requestData['permission_ids']);
            }

            $role->fill($requestData);
            $role->save();

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::debug('角色编辑失败：'. $e->getFile().'|'.$e->getLine().'|'.$e->getMessage());
            $this->error('角色编辑失败');
        }

        $this->success(null,'角色编辑成功');
    }

    /**
     * 删除
     * @throws ResultException
     */
    public function destroy(int $id): void
    {
        //删除前置
        $this->destroyBeforeHandler();

        $role = $this->model::query()->find($id);

        if($role->users->isNotEmpty()){
            $this->error('该角色下有使用用户，不能删除');
        }

        //删除
        $result = $this->model::destroy($id);

        if (!$result) {
            $this->error();
        }

        //后置删除
        $this->destroyAfterHandler($id);

        $this->success();
    }
}
