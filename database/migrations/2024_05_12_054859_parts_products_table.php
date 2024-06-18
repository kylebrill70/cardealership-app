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
        Schema::create('parts_product', function (Blueprint $table) {
            $table->id('parts_id');
            $table->string('parts_image')->nullable();
            $table->string('parts_name',55);
            $table->double('price');
            $table->unsignedBigInteger('parts_type_id');
            $table->timestamps();

            $table->foreign('parts_type_id') //1st parenthesis column of the f key in the table
            ->references('parts_type_id') // 2nd the column what column the f key from the table of genders
            ->on('parts_type') //name of table where the f key from
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
