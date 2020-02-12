<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarPlateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_plate_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('key');
            $table->unsignedInteger('province_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('province_id')
                    ->references('id')->on('provinces')
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
        Schema::dropIfExists('car_plate_cities');
    }
}
