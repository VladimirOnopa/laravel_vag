<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsCargo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options_cargo', function (Blueprint $table) {
            $table->id()->index('id');
            $table->bigInteger('cargo_request_id')->index('cargo_request_id')->unsigned();
            $table->bigInteger('option_id')->index('option_id')->unsigned();
            $table->mediumText('value');
            $table->foreign('cargo_request_id')->references('id')->on('cargo_request')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options_cargo');
    }
}
