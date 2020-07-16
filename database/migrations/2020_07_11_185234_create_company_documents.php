<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_documents', function (Blueprint $table) {
            $table->id()->index('id');
            $table->string('file',40)->unique();
            $table->bigInteger('company_id')->unsigned()->index('company_id');
            $table->dateTime('verified_at')->index('verified_at');
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
        Schema::dropIfExists('company_documents');
    }
}
