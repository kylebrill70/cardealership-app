<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id('cars_id');
            $table->string('cars_image')->nullable();
            $table->string('car_name',55);
            $table->string('engine_name',55);
            $table->string('description',255);
            $table->double('price');
            $table->unsignedBigInteger('car_type_id');
            $table->timestamps();

            $table->foreign('car_type_id') //1st parenthesis column of the f key in the table
            ->references('car_type_id') // 2nd the column what column the f key from the table of genders
            ->on('car_type') //name of table where the f key from
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
