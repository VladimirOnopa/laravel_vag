<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_review', function (Blueprint $table) {
            $table->id()->index('id');
            $table->bigInteger('company_id')->index('company_id')->unsigned()->comment('Отзыв на компанию');
            $table->bigInteger('company_id_author')->index('company_id_author')->unsigned()->comment('Оставлен компанией');
            $table->mediumInteger('rating')->index('rating')->unsigned()->comment('Рейтинг');
            $table->mediumInteger('quality')->index('quality')->unsigned()->comment('Качество');
            $table->mediumInteger('load_time')->index('load_time')->unsigned()->comment('Соблюдение сроков загрузки');
            $table->mediumInteger('transport_status')->index('transport_status')->unsigned()->comment('Состояние транспортного средства');
            $table->mediumInteger('cargo_save')->index('cargo_save')->unsigned()->comment('Сохранность груза');
            $table->mediumInteger('doc_rules')->index('doc_rules')->unsigned()->comment('Правильность оформления доков');
            $table->mediumInteger('doc_created')->index('doc_created')->unsigned()->comment('Заказчик\Правильность оформления доков');
            $table->mediumInteger('cargo_load_time')->index('cargo_load_time')->unsigned()->comment('Заказчик\Соблюдение срока загрузки, выгрузки');
            $table->mediumInteger('payment')->index('payment')->unsigned()->comment('Заказчик\Своевременность оплаты');
            $table->text('text_review')->comment('Заказчик\Своевременность оплаты');
            $table->date('load')->comment('Дата загрузки');
            $table->integer('trip_from_country')->unsigned()->comment('Страна загруз.');
            $table->integer('trip_from_city')->unsigned()->comment('Город загруз.'); 
            $table->integer('trip_to_country')->unsigned()->comment('Страна выгруз.');
            $table->integer('trip_to_city')->unsigned()->comment('Город выгруз.');
            $table->integer('cargo_type')->unsigned()->comment('Тип груза');
            $table->dateTime('created_at')->index('created_at');
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
        Schema::dropIfExists('company_review');
    }
}
