<?php
/**
 * User: Edward Yu
 * Date: 2021/8/31

 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasRolesTable extends Migration
{
    public function up(): void
    {
        Schema::create('user_has_roles', function (Blueprint $table) {
            //用户角色表
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->comment('用户id');
            $table->json('role_ids')->comment('角色id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_has_roles');
    }
}
