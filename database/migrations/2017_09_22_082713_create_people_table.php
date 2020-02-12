<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('nationalId');
            $table->date('birthdate')->nullable();
            $table->string('father')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('picture')->nullable();
            $table->integer('gender_id')->unsigned();
            $table->integer('melliat_id')->unsigned();
            $table->integer('city_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('gender_id')
                    ->references('id')->on('genders')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('city_id')
                    ->references('id')->on('cities')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('melliat_id')
                    ->references('id')->on('melliats')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
