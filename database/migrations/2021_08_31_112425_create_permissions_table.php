<?php
/**
 * User: Edward Yu
 * Date: 2021/8/31

 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('menu_permissions', function (Blueprint $table) {
            //权限表
            $table->bigIncrements('id');
            $table->integer('parent_id')->unsigned()->default(0)->comment('父级权限id');
            $table->string('name', 20)->comment('菜单权限名');
            $table->string('route_name', 50)->comment('后端路由标识')->nullable();
            $table->string('view_route_name', 50)->comment('前端模块名')->nullable();
            $table->string('view_route_path', 50)->comment('前端路径')->nullable();
            $table->boolean('menu_type')->comment('菜单类型 1菜单 2目录 3按钮')->nullable();
            $table->boolean('is_hidden')->comment('是否隐藏');
            $table->unsignedInteger('sort')->comment('排序')->default(1);
            $table->string('icon', 100)->comment('菜单图标')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE menu_permissions COMMENT = '菜单权限表'");//表注释
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_permissions');
    }
}
