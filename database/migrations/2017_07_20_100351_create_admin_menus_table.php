<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->nullable(false)->default(0)->comment('父级ID');
            $table->string('text')->nullable(false)->comment('菜单文字');
            $table->string('route_name')->nullable(true)->default(null)->comment('路由名称');
            $table->text('url')->nullable(true)->default(null)->comment('链接地址');
            $table->string('icon_class')->nullable(true)->default(null)->comment('css图标');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_menus');
    }
}
