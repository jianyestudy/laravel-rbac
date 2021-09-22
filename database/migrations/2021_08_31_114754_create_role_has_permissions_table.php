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
        Schema::create('role_has_permissions', function (Blueprint $table) {
            // 角色与权限关联表
            $table->bigIncrements('id');
            $table->integer('role_id')->unsigned()->comment('角色id')->unique();
            $table->json('permission_ids')->comment('权限ids');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_has_permissions');
    }
}
