<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->id()->index('id');
            $table->bigInteger('company_id')->unsigned()->index('company_id')->comment('Кто пригласил');
            $table->mediumText("email_to");
            $table->string("invite_сode",30)->unique();
            $table->dateTime('created_at')->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invites');
    }
}
