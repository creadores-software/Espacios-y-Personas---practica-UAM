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
        Schema::create('space_reserves', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('title');
            $table->string('description');
            $table->enum('reserve', ['8-10','10-12','2-4','4-6']);
            $table->unsignedBigInteger('space_id');
            $table->foreign('space_id')->references('id')->on('spaces')->onDelete('cascade');
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
        Schema::dropIfExists('space_reserves');
    }
};
