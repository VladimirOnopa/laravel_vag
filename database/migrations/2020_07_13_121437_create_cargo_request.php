<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_request', function (Blueprint $table) {
            $table->id()->index('id');
            $table->bigInteger('user_id')->unsigned()->index('user_id');
            $table->string('tel')->nullable();
            $table->string('tel_second')->nullable();
            $table->string('site_url')->nullable();
            $table->string('skype')->nullable();
            $table->string('viber')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable(); 
            $table->date('load_date_from')->index('load_date_from')->comment('Дата нач. загр.');
            $table->date('load_date_to')->index('load_date_to')->comment('Дата зав. загр.');
            $table->mediumInteger("body_type")->unsigned()->index('body_type');
            $table->mediumInteger("cargo_type")->unsigned()->index('cargo_type');
            $table->mediumInteger("size_l")->unsigned()->index('size_l')->nullable();
            $table->mediumInteger("size_w")->unsigned()->index('size_w')->nullable();
            $table->mediumInteger("size_h")->unsigned()->index('size_h')->nullable();
            $table->mediumInteger("weight_max")->unsigned()->index('weight_max')->nullable();
            $table->mediumInteger("capacity")->unsigned()->index('capacity')->nullable();
            $table->mediumInteger("quantity_transport")->unsigned()->index('quantity_transport')->nullable();
            $table->mediumInteger("price_show")->unsigned()->index('price_show')->comment('Запрос/сум.')->nullable();
            $table->mediumInteger("payment_type")->unsigned()->index('payment_type')->comment('нал/бн')->nullable();
            $table->mediumInteger("nds")->unsigned()->index('nds')->nullable();
            $table->mediumInteger("price_amount")->unsigned()->index('price_amount')->nullable();
            $table->mediumInteger("currency")->unsigned()->index('currency')->nullable();
            $table->smallInteger("per_type")->unsigned()->index('per_type')->comment('За км/т')->nullable();
            $table->mediumInteger("prepay")->unsigned()->index('prepay')->nullable();
            $table->mediumInteger("payment_time")->unsigned()->index('payment_time')->nullable();
            $table->mediumText("notice")->nullable();
            $table->tinyInteger("active")->unsigned()->index('active')->default(1);
            $table->dateTime('created_at')->index('created_at');
            $table->dateTime('refresh_at')->index('refresh_at');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargo_request');
    }
}
