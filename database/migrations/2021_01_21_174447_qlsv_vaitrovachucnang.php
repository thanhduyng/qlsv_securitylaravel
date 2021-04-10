<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QlsvVaitrovachucnang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_vaitrovachucnangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_vaitro');
            $table->bigInteger('id_chucnang');
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
        Schema::dropIfExists('qlsv_vaitrovachucnangs');
    }
}
