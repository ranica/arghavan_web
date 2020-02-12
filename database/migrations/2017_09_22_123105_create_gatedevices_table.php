<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatedevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gatedevices', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->unique();
            $table->string('ip');
            $table->string('number');
            // type: Logical = 1, Physical = 0
            $table->integer('type');
            // gate: Gate = 1, Antenna = 3, Fingerprint = 2
            $table->unsignedInteger('device_type_id');
            $table->boolean('state')->nullable();
            $table->unsignedInteger('gategender_id');
            $table->unsignedInteger('gatepass_id');
            $table->unsignedInteger('zone_id');
            $table->unsignedInteger('gatedirect_id');
            $table->boolean('netState')->nullable();
            $table->integer('timepass')->nullable();
            $table->integer('timeserver')->nullable();
            // $table->integer('group_id')->unsigned();
            $table->softDeletes();

            $table->foreign('gategender_id')
                    ->references('id')->on('gategenders')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('gatepass_id')
                    ->references('id')->on('gatepasses')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('zone_id')
                    ->references('id')->on('zones')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('gatedirect_id')
                    ->references('id')->on('gatedirects')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('device_type_id')
                    ->references('id')->on('device_types')
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
        Schema::dropIfExists('gatedevices');
    }
}
