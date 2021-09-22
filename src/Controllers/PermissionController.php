<?php

namespace QCYX\LaravelRbac\Controllers;

use App\Http\Controllers\Controller;
use QCYX\LaravelApi\Exceptions\ResultException;
use QCYX\LaravelApi\Traits\ResultTrait;
use QCYX\LaravelRbac\Models\Permission;
use QCYX\LaravelRbac\Requests\PermissionRequest;

class PermissionController extends Controller
{
    use ResultTrait;
    protected  $model;

    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    /**
     * 权限列表
     * @param PermissionRequest $request
     * @throws ResultException
     * @Another Edward Yu 2021/9/6下午3:14
     */
    public function index(PermissionRequest $request): void
    {
        $requestData = $request->indexCheck($request->toArray()());

        $builder = Permission::query();

        if (!empty($requestData['keyword'])) {
            $builder->where('title', $requestData['keyword']);
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
     * 新增权限
     * @param PermissionRequest $request
     * @throws ResultException
     * @Another Edward Yu 2021/9/6下午3:15
     */
    public function store(PermissionRequest $request): void
    {
        $requestData = $request->storeCheck($request->toArray()());

        $filled  = $this->model->fill($requestData)->save();

        if ( !$filled ) {
            $this->error();
        }
        $this->success();


    }

    /**
     * 展示详情
     * @param PermissionRequest $request
     * @param int $id
     * @throws ResultException
     * @Another Edward Yu 2021/9/6下午3:17
     */
    public function show(PermissionRequest $request, int $id): void
    {
        $request->showCheck($request->toArray());

        $result = Permission::query()->find($id);

        if ($result->isEmpty()) {
            $this->noData();
        }

        $this->success($result);
    }

    /**
     * 更新权限
     * @param PermissionRequest $request
     * @param int $id
     * @throws ResultException
     * @Another Edward Yu 2021/9/6下午3:18
     */
    public function update(PermissionRequest $request, int $id): void
    {
        $requestData = $request->updateCheck($request->toArray());

        $find = Permission::query()->firstOr($id, function (){
            $this->noData();
        });

        $result = $find->fill($requestData)->save();

        if (!$result) {
            $this->error();
        }
        $this->success();
    }

    /**
     * 删除权限
     * @param int $id
     * @throws ResultException
     * @Another Edward Yu 2021/9/6下午3:20
     */
    public function destroy(int $id): void
    {
        if (Permission::destroy($id)) {
            $this->error();
        }
        $this->success();
    }
}
