<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('card_id')->nullable();
            $table->unsignedInteger('car_color_id')->nullable();
            $table->unsignedInteger('car_fuel_id')->nullable();
            $table->unsignedInteger('car_level_id')->nullable();
            $table->unsignedInteger('car_system_id')->nullable();
            $table->unsignedInteger('car_model_id')->nullable();
            $table->unsignedInteger('car_type_id')->nullable();
            $table->unsignedInteger('car_plate_type_id')->nullable();
            $table->unsignedInteger('car_plate_city_id')->nullable();
            $table->string('plate_first');
            $table->string('plate_second');
            $table->string('plate_word');
            $table->string('model')->nullable();
            $table->string('capacity')->nullable();
            $table->string('chasiscode')->nullable();
            $table->string('enginecode')->nullable();
            $table->boolean('state')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('card_id')
                    ->references('id')->on('cards')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('car_color_id')
                    ->references('id')->on('car_colors')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('car_fuel_id')
                    ->references('id')->on('car_fuels')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('car_level_id')
                    ->references('id')->on('car_levels')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

        $table->foreign('car_system_id')
                    ->references('id')->on('car_systems')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

        $table->foreign('car_model_id')
                    ->references('id')->on('car_models')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

        $table->foreign('car_type_id')
                    ->references('id')->on('car_types')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

        $table->foreign('car_plate_city_id')
                    ->references('id')->on('car_plate_cities')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

        $table->foreign('car_plate_type_id')
                    ->references('id')->on('car_plate_types')
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
        Schema::dropIfExists('cars');
    }
}
