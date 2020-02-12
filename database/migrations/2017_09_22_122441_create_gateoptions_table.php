<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGateoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateoptions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('startDate');
            $table->date('endDate');
            $table->integer('genzonew_id')->unsigned();
            $table->integer('genzonem_id')->unsigned();
            $table->boolean('emergency')->nullable();
            $table->integer('port')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('genzonew_id')
                    ->references('id')->on('gatezones')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

             $table->foreign('genzonem_id')
                    ->references('id')->on('gatezones')
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
        Schema::dropIfExists('gateoptions');
    }
}
