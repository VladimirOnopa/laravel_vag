<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
            $table->id()->index('id'); 
            $table->string('name');
            $table->string('surname');
            $table->string('tel');
            $table->string('tel_second')->nullable();
            $table->string('site_url')->nullable();
            $table->string('skype')->nullable();
            $table->string('viber')->nullable();
            $table->string('whatsapp')->nullable();
            $table->integer('user_type')->unsigned()->index('user_type')->default(1);//Дефолтный тип юзера
            $table->integer('user_access_type')->unsigned()->index('user_access_type')->default(1);//Юр лицо тип юзера
            $table->string('email')->unique(); 
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->dateTime('last_active')->index('last_active');
            $table->dateTime('register_date')->index('register_date');
            $table->rememberToken();
            $table->foreign('user_access_type')->references('id')->on('user_access_type');
            $table->foreign('user_type')->references('id')->on('user_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
