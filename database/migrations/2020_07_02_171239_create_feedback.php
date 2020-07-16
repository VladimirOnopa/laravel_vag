<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id()->index('id');
            $table->bigInteger('user_id')->unsigned()->index('user_id');
            $table->mediumText('name');
            $table->mediumText('email');
            $table->text('message');
            $table->mediumText('subject');
            $table->string('phote',18);
            $table->dateTime('date_time')->index('date_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
