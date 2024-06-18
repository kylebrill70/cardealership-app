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
        Schema::create('deleted_users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('full_name',155);
            $table->unsignedBigInteger('gender_id');
            $table->string('address',55);
            $table->string('contact_number',55);
            $table->string('username',55)->unique();
            $table->string('password',255);
            $table->unsignedBigInteger('user_access_id');
            $table->timestamps();

            $table->foreign('gender_id') //1st parenthesis column of the f key in the table
            ->references('gender_id') // 2nd the column what column the f key from the table of genders
            ->on('genders') //name of table where the f key from
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('user_access_id') //1st parenthesis column of the f key in the table
            ->references('user_access_id') // 2nd the column what column the f key from the table of genders
            ->on('access_type') //name of table where the f key from
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
