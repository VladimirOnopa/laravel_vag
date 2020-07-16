<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyWorkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_workers', function (Blueprint $table) {
            $table->id()->index('id');
            $table->bigInteger('user_id')->unsigned()->index('user_id');
            $table->bigInteger('company_id')->unsigned()->index('company_id');
            $table->smallInteger('is_admin')->unsigned()->index('is_admin')->comment('1-да,0-нет');
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_workers');
    }
}
