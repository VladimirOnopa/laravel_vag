<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTransport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options_transport', function (Blueprint $table) {
            $table->id()->index('id');
            $table->bigInteger('transport_request_id')->index('transport_request_id')->unsigned();
            $table->bigInteger('option_id')->index('option_id')->unsigned();
            $table->mediumText('value');
            $table->foreign('transport_request_id')->references('id')->on('transport_request')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options_transport');
    }
}
