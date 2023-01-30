<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->longText('requirement');
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('type_id');
            $table->timestamps();


            $table->foreign('employer_id')->references('id')->on('employers')->cascadeOnDelete();
            $table->foreign('status_id')->references('id')->on('status_vacancies')->cascadeOnDelete();
            $table->foreign('type_id')->references('id')->on('type_vacancies')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
};
