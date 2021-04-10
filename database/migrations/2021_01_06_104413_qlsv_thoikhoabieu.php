<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QlsvThoikhoabieu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_thoikhoabieus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_lophoc');
            $table->integer('buoithu');
            $table->date('ngayhoc');
            $table->integer('cahoc');
            $table->integer('diadiemhoc');
            $table->time('giovao');
            $table->time('giobatdau');
            $table->integer('danhgiagiovao');
            $table->integer('lydogiovao');
            $table->time('giora');
            $table->integer('danhgiagiora');
            $table->integer('lydogiora');
            $table->integer('siso');
            $table->integer('thuchientot');
            $table->integer('khonglamduoc');
            $table->string('loinhanphongdaotao');
            $table->string('danhgiacuagiangvien');
            $table->string('loinhancuagiangvien');
            $table->string('ghichu');
            $table->bigInteger('id_worktask');
            $table->bigInteger('id_phonghoc');
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
        Schema::dropIfExists('qlsv_thoikhoabieus');
    }
}
