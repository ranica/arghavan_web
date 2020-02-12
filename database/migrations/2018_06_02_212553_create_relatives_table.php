<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatives', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('people_id')->unsigned();
            $table->integer('kintype_id')->unsigned();
            $table->string('name');
            $table->string('lastname');
            $table->string('phone')->nullable();
            $table->string('mobile');
            // $table->integer('city_id')->unsigned();
            $table->string('address')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('people_id')
                    ->references('id')->on('people')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('kintype_id')
                    ->references('id')->on('kintypes')
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
        Schema::dropIfExists('relatives');
    }
}
