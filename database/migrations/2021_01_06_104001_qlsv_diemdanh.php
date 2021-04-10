<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QlsvDiemdanh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_diemdanhs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_sinhvienlophoc');
            $table->integer('id_thoikhoabieu');
            $table->tinyInteger('denlop');
            $table->tinyInteger('thuchanh');
            $table->tinyInteger('kienthuc');
            $table->string('ghichu');
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
        Schema::dropIfExists('qlsv_diemdanhs');
    }
}
