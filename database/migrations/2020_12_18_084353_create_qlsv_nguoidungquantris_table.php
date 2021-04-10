<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQlsvNguoidungquantrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_nguoidungquantris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten');
            $table->string('diachi');
            $table->tinyInteger('gioitinh');
            $table->integer('sodienthoai');
            $table->tinyInteger('gmail');
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
        Schema::dropIfExists('qlsv_nguoidungquantris');
    }
}
