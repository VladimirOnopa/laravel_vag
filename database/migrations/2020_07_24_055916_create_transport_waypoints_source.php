<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportWaypointsSource extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_waypoints_source', function (Blueprint $table) {
            $table->id()->index('id');
            $table->bigInteger('request_id')->unsigned()->index('request_id');
            $table->Integer('country')->unsigned()->index('country');
            $table->bigInteger('region')->unsigned()->nullable()->index('region');
            $table->bigInteger('city')->unsigned()->nullable()->index('city');
            $table->tinyInteger('order')->unsigned()->index('order');
            $table->foreign('request_id')->references('id')->on('transport_request')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transport_waypoints_source');
    }
}
