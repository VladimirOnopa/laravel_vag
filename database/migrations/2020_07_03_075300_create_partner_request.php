<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_request', function (Blueprint $table) {
            $table->id()->index('id');
            $table->bigInteger("company_id_request_from")->unsigned()->index('company_id_request_from')->comment('От кого запрос');
            $table->bigInteger("company_id_request_to")->unsigned()->index('company_id_request_to')->comment('Кому запрос');
            $table->dateTime('created_at')->index('created_at');
            $table->foreign('company_id_request_from')->references('id')->on('company')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_request');
    }
}
