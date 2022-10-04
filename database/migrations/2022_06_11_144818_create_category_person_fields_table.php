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
        Schema::create('category_person_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_person_id');
            $table->unsignedBigInteger('owner');
            $table->foreign('category_person_id')->references('id')->on('category_people')->onDelete('cascade');
            $table->foreign('owner')->references('id')->on('people')->onDelete('cascade');
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_person_fields');
    }
};
