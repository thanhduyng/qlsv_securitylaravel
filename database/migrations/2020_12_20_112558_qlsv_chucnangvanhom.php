<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QlsvChucnangvanhom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_chucnangvanhoms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idchucnang');
            $table->bigInteger('idnhom');
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
        Schema::dropIfExists('qlsv_chucnangvanhoms');
    }
}
