<?php

namespace QCYX\LaravelRbac\Controllers;

use App\Http\Controllers\Controller;
use QCYX\LaravelApi\Exceptions\ResultException;
use QCYX\LaravelApi\Traits\ResultTrait;
use QCYX\LaravelRbac\Models\Role;
use QCYX\LaravelRbac\Requests\RoleRequest;

class RoleController extends Controller
{
    use ResultTrait;

    protected  $model;

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * 权限列表
     * @param RoleRequest $request
     * @throws ResultException
     * @Another Edward Yu 2021/9/2下午6:01
     */
    public function index(RoleRequest $request): void
    {
        $requestData = $request->indexCheck($request->toArray());

        $builder = Role::query();

        if (!empty($requestData['keyword'])) {
            $builder->where('name', $requestData['keyword']);
        }

        //查询类型
        if ( !empty($requestData['type']) && ($requestData['type'] === 'all' ) ){
            $result = $builder->get();
        }else{
            $limit = $requestData['limit'] ?? 10;
            $result = $builder->paginate($limit);
        }

        $this->success($result);

    }

    /**
     * 新增权限.
     *
     * @param RoleRequest $request
     * @throws ResultException
     */
    public function store(RoleRequest $request): void
    {
        $requestData = $request->storeCheck($request->toArray());

        $filled  = $this->model->fill($requestData)->save();

        if ( !$filled ) {
              $this->error();
        }
          $this->success($filled);
    }

    /**
     * 展示角色详情.
     *
     * @param RoleRequest $request
     * @param int $id
     * @throws ResultException
     */
    public function show(RoleRequest $request, int $id): void
    {
        $request->showCheck($request->toArray());

        $result = Role::query()->find($id);

        $this->success($result);
    }

    /**
     * 更新角色详情.
     *
     * @param RoleRequest $request
     * @param int $id
     * @return void
     * @throws ResultException
     */
    public function update(RoleRequest $request, int $id): void
    {
        $requestData = $request->updateCheck($request->toArray());

        $find = Role::query()->firstOr($id, function (){
            $this->noData();
        });

        $result = $find->fill($requestData)->save();

        if (!$result) {
            $this->error();
        }
        $this->success();
    }

    /**
     * 删除角色.
     *
     * @param int $id
     * @throws ResultException
     */
    public function destroy(int $id): void
    {
        if (Role::destroy($id)) {
            $this->error();
        }
        $this->success();
    }
}
