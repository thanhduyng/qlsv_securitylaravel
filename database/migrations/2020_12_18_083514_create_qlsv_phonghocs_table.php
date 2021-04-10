<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQlsvPhonghocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_phonghocs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tenphonghoc');
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
        Schema::dropIfExists('qlsv_phonghocs');
    }
}
