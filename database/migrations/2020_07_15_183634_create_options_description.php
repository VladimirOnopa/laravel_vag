<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options_description', function (Blueprint $table) {
            $table->id()->index('id');
            $table->mediumText('name');
            $table->mediumText('type');
            $table->mediumText('group')->comment('Доки/Погрузка');
            $table->mediumText('type_variant')->comment('Груз\Транспорт');
            $table->integer('order')->index('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options_description');
    }
}
