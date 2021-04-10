<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQlsvWorktasksinhvienlophocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_worktasksinhvienlophocs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_sinhvienlophoc');
            $table->bigInteger('id_worktask');
            $table->date('ngaydanhgia');
            $table->string('ykienkhac');
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
        Schema::dropIfExists('qlsv_worktasksinhvienlophocs');
    }
}
