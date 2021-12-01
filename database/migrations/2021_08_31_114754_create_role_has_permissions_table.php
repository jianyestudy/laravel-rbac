<?php
/**
 * User: Edward Yu
 * Date: 2021/8/31

 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleHasPermissionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            // 角色与权限关联表
            $table->bigIncrements('id');
            $table->unsignedInteger('role_id')->unsigned()->comment('角色id');
            $table->unsignedInteger('permission_id')->comment('权限id');
            $table->tinyInteger('is_half_select')->comment('是否是半选中的权限 1是 2否');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE role_permissions COMMENT = '角色菜单关联'");//表注释
    }

    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
}
