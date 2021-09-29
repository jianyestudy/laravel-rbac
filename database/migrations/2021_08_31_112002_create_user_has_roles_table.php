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
        Schema::create('user_role', function (Blueprint $table) {
            //用户角色表
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->comment('用户id');
            $table->integer('role_id')->comment('角色id');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE user_role COMMENT = '用户角色关联表'");//表注释
    }

    public function down(): void
    {
        Schema::dropIfExists('user_role');
    }
}
