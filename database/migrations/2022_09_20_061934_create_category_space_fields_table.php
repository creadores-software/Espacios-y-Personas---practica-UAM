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
        Schema::create('category_space_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_space_id');
            $table->unsignedBigInteger('space');
            $table->foreign('category_space_id')->references('id')->on('category_spaces')->onDelete('cascade');
            $table->foreign('space')->references('id')->on('spaces')->onDelete('cascade');
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
        Schema::dropIfExists('category_space_fields');
    }
};
