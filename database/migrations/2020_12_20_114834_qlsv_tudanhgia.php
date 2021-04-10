<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QlsvTudanhgia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_tudanhgias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_monhoc');
            $table->string('tieude');  
            $table->string('cauhoi');  
            $table->string('thutu');  
            $table->integer('soluongcautraloi');
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
        Schema::dropIfExists('qlsv_tudanhgias');
    }
}
