<?php
/**
 * User: Edward Yu
 * Date: 2021/8/31

 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            //用户权限表
            $table->bigIncrements('id');
            $table->string('name', '20')->comment('角色名');
            $table->string('flag', '20')->comment('角色标识 如admin ');
            $table->boolean('status')->comment('角色状态 0禁用 1启用')->default(true);
            $table->unsignedInteger('sort')->comment('权重排序 ，数值越大，排名越后');
            $table->string('remark', '50')->comment('备注');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE roles COMMENT = '角色表'");//表注释
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
}
