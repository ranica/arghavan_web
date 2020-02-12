<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFpDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fp_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip');
            $table->integer('port');
            $table->string('name');
            $table->unsignedInteger('gate_direct_id');
            $table->boolean('net_state');
            $table->boolean('enabled');
            $table->json('extra')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('gate_direct_id')
                    ->references('id')
                    ->on('gatedirects')
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
        Schema::dropIfExists('fp_devices');
    }
}
