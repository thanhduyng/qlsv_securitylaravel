<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQlsvThongbaonoinguoinhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_thongbaonoinguoinhans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_thongbao');
            $table->integer('id_nguoinhan');
            $table->date('ngaydoc');
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
        Schema::dropIfExists('qlsv_thongbaonoinguoinhans');
    }
}
