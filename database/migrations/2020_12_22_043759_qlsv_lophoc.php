<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QlsvLophoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_lophocs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tenlophoc');
            $table->bigInteger('id_giangvien');
            $table->bigInteger('id_khoahoc');
            $table->bigInteger('id_monhoc');
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
        Schema::dropIfExists('qlsv_lophocs');
    }
}
