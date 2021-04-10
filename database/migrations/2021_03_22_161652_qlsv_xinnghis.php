<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QlsvXinnghis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_xinnghis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_thoikhoabieu');
            $table->string('noidung');
            $table->string('lydo');
            $table->integer('id_sinhvienlophoc');
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
        Schema::dropIfExists('qlsv_xinnghis');
    }
}
