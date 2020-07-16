<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id()->index('id');
            $table->bigInteger("company_id")->unsigned()->index('company_id')->comment('Основная компания');
            $table->bigInteger("company_partner_id")->unsigned()->index('company_partner_id')->comment('Партнер компании');
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
        Schema::dropIfExists('partners');
    }
}
