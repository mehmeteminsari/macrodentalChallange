<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Form extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
        $table->id()->autoIncrement();
        $table->string('fname')->nullable();
        $table->string('lname')->nullable();
        $table->string('balance')->nullable();
        $table->string('password')->nullable();
        $table->string('phone')->nullable();
        $table->date('birth_day')->nullable();
        $table->string('city_name')->nullable();
        $table->string('district_name')->nullable();
        $table->string('p_image')->nullable();
        $table->boolean('natification')->default(false);
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
        //
    }
}
