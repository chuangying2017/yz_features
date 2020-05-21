<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTblTmpImg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tmp_img', function (Blueprint $table) {

            $table->id();
            $table->integer('uid')->default(0);
            $table->integer('site_id')->default(0);
            $table->string('name')->nullable()->comment('上传图片名称');
            $table->string('img_path')->nullable()->comment('上传图片路径');
            $table->timestamps();
        });

        \DB::statement("alter table `tbl_tmp_img` comment '临时存储图片'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_tmp_img');
    }
}
