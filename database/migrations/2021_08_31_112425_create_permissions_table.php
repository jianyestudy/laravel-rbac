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
        Schema::create('permissions', function (Blueprint $table) {
            //权限表
            $table->bigIncrements('id');
            $table->integer('pid')->unsigned()->default(0)->comment('父级权限id');
            $table->string('title', 20)->comment('权限名');
            $table->string('name', 50)->comment('后端路由标识');
            $table->string('view_router_name', 50)->comment('前端模块名')->nullable();
            $table->string('view_router_path', 50)->comment('前端路径')->nullable();
            $table->boolean('is_menu')->comment('是否是菜单');
            $table->boolean('is_hidden')->comment('是否隐藏');
            $table->unsignedInteger('weight')->comment('权重')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
}
