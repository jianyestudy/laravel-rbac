<?php

namespace QCS\LaravelRbac\Controllers;

use Illuminate\Database\Eloquent\Builder;
use QCS\LaravelApi\Controllers\BaseController;
use QCS\LaravelApi\Exceptions\ResultException;
use QCS\LaravelApi\Traits\ResultTrait;
use QCS\LaravelRbac\Models\Permission;
use QCS\LaravelRbac\Requests\PermissionRequest;

class PermissionController extends BaseController
{
    use ResultTrait;
    public function __construct(PermissionRequest $request, Permission $model)
    {
        $this->request = $request;
        $this->model   = $model;
    }

    /**
     * @throws ResultException
     */
    public function simple(){
        $builder = $this->model->query();

        if(request()->keyword){
            $builder->where('name','like',request()->keyword);
        }

        $result = $builder->select('id','name','parent_id')->get();

        $resultArray = $result->toArray();

        if(request()->isTree){
            $temp = [];
            foreach ($result as $key => $item){
                if($item->parent_id != 0){
                    unset($result[$key]);
                }else{
                    $temp[] = $this->getTree($item->toArray(),$resultArray,1);
                }
            }
            $result = $temp;
        }

        $this->success($result);
    }

    /**
     * 按名称筛选
     * @param Builder $builder
     * @param array $requestData
     * @Another Edward Yu 2021/9/27下午8:24
     */
    public function indexSearch(Builder $builder, array  $requestData):void
    {
        if ( !empty($requestData['keyword']) ) {
            $keyword = $requestData['keyword'];
            $builder->where('name', 'like', "%$keyword%");
        }

        $builder->orderBy('sort');
    }

    public function getTree($arr, $menu,$level){
        $arr['level'] = $level;
        if (!$arr['parent_id']) {
            $arr['children'] = [];
        }

        foreach ($menu as $key => $value) {
            if ($arr['id'] == $value['parent_id']) {
                $temp = [];
                $temp = $this->getTree($value, $menu,$level + 1);
                if ($temp) {
                    $arr['children'][] = $temp;
                }
            }
        }

        return $arr;
    }
}
