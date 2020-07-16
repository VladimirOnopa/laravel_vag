<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccessTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_access_type', function (Blueprint $table) {
            $table->increments('id')->index('id');
            $table->mediumText('name_access_type')->comment('Название премиум услуги пользователя');
            $table->mediumText('plus_one');
            $table->mediumText('plus_two');
            $table->mediumText('plus_three');
            $table->mediumText('plus_four');
            $table->mediumText('plus_five');
            $table->mediumInteger('price');
            $table->mediumText('currency');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_access_type');
    }
}
