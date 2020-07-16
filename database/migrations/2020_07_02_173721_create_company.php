<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id()->index('id');
            $table->bigInteger('user_id')->unsigned()->index('user_id')->comment('Админ');
            $table->mediumText('company_name');
            $table->mediumText('company_slug')->nullable()->comment('Слоган компании');
            $table->integer('country_company')->unsigned()->index('country_company')->nullable();
            $table->integer('region_company')->unsigned()->index('region_company')->nullable();
            $table->integer('city_company')->unsigned()->index('city_company')->nullable();
            $table->mediumText('profile_company')->comment('Специализац. компании')->nullable();
            $table->mediumText('inn')->comment('ИНН компании')->nullable();
            $table->dateTime('rename_comp_date')->index('rename_comp_date')->comment('Дата переименов. компании')->nullable();
            $table->dateTime('created_at')->index('created_at');
            $table->tinyInteger('verified')->index('verified');
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
        Schema::dropIfExists('company');
    }
}
