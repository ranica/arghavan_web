<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatetrafficsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gatetraffics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->datetime('gatedate')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('gatedevice_id')->unsigned();
            $table->integer('gatepass_id')->unsigned();
            $table->integer('gatedirect_id')->unsigned();
            $table->integer('gatemessage_id')->unsigned();
            $table->integer('gateoperator_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('gatedevice_id')
                    ->references('id')
                    ->on('gatedevices')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('gatepass_id')
                    ->references('id')
                    ->on('gatepasses')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

             $table->foreign('gatedirect_id')
                    ->references('id')
                    ->on('gatedirects')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('gatemessage_id')
                    ->references('id')
                    ->on('gatemessages')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

             $table->foreign('gateoperator_id')
                    ->references('id')
                    ->on('gateoperators')
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
        Schema::dropIfExists('gatetraffics');
    }
}
