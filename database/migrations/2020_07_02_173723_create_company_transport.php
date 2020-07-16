<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTransport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_transport', function (Blueprint $table) {
            $table->id()->index('id');
            $table->bigInteger("company_id")->unsigned()->index('company_id');
            $table->mediumInteger("owner_type")->unsigned()->comment('Аренда/собственник транспорта');
            $table->mediumText("name")->comment('Название транспорта');
            $table->mediumText("drive_name")->comment('ФИО водителя');
            $table->mediumInteger("size_l")->unsigned()->comment('Габариты\длин.');
            $table->mediumInteger("size_w")->unsigned()->comment('Габариты\шир.');
            $table->mediumInteger("size_h")->unsigned()->comment('Габариты\выс.');
            $table->mediumInteger("weight_max")->unsigned()->comment('Грузопод.');
            $table->mediumInteger("capacity")->unsigned()->comment('Объем');
            $table->mediumInteger("load_type")->unsigned()->comment('Тип загрузки');
            $table->mediumText("user_note")->comment('Примечания');
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
        Schema::dropIfExists('company_transport');
    }
}
