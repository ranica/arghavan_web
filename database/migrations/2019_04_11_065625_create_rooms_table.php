<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('number');
            $table->unsignedInteger('capacity');
            $table->unsignedInteger('floor');
            $table->unsignedInteger('building_id');
            $table->unsignedInteger('gender_id');
            $table->softDeletes();

            $table->foreign('building_id')
                    ->references('id')
                    ->on('buildings')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('gender_id')
                    ->references('id')
                    ->on('gategenders')
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
        Schema::dropIfExists('rooms');
    }
}
