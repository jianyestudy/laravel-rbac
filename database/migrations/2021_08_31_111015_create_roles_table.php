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
            $table->unsignedInteger('pid')->comment('父id,0无上级')->default(0);
            $table->string('name', '20')->unique()->comment('角色名');
            $table->string('remark', '50')->comment('备注');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
}
