<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('building_id');
            $table->unsignedInteger('term_id');
            $table->unsignedInteger('degree_id');
            $table->unsignedInteger('gate_plan_id');
            $table->json('extra');
            $table->softDeletes();

            $table->foreign('building_id')
                    ->references('id')
                    ->on('buildings')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('degree_id')
                    ->references('id')
                    ->on('degrees')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('term_id')
                    ->references('id')
                    ->on('terms')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('gate_plan_id')
                    ->references('id')
                    ->on('gate_plans')
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
        Schema::dropIfExists('building_informations');
    }
}
