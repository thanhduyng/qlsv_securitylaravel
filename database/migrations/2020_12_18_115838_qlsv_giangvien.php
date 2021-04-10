<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QlsvGiangvien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_giangviens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user');
            $table->String('hovaten');
            $table->date('ngaysinh');   
            $table->String('diachi');
            $table->tinyInteger('gioitinh');
            $table->integer('sodienthoai');
            $table->String('gioithieu');
            $table->String('ghichu');
            $table->string('nguoitao');
            $table->string('nguoisua');
            $table->integer('deleted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qlsv_giangviens');
    }
}
