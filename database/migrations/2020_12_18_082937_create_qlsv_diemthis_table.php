<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQlsvDiemthisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_diemthis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_sinhvienlophoc');
            $table->double('diemlythuyet');
            $table->double('diemthuchanh');
            $table->date('ngaychodiem');
            $table->bigInteger('id_kieuthi');
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
        Schema::dropIfExists('qlsv_diemthis');
    }
}
