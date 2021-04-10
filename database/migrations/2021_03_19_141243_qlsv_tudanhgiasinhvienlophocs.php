<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QlsvTudanhgiasinhvienlophocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlsv_tudanhgiasinhvienlophocs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_sinhvienlophoc');
            $table->bigInteger('id_tudanhgia');
            $table->string('cautraloi');
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
        Schema::dropIfExists('qlsv_tudanhgiasinhvienlophocs');
    }
}
