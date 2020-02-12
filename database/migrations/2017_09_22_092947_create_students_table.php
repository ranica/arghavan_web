<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->boolean('suit')->default(false);
            $table->boolean('native')->default(false);
            // $table->string('year');
            // $table->string('term');
            $table->integer('degree_id')->unsigned();
            $table->integer('field_id')->unsigned();
            $table->integer('part_id')->unsigned();
            $table->integer('situation_id')->unsigned();
            // $table->integer('kin_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('term_id')
                    ->references('id')->on('terms')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('degree_id')
                    ->references('id')->on('degrees')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('field_id')
                        ->references('id')->on('fields')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->foreign('part_id')
                        ->references('id')->on('parts')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->foreign('situation_id')
                        ->references('id')->on('situations')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');


            // $table->foreign('kin_id')->references('id')
            //     ->on('kins')
            //     ->onDelete('cascade')
            //     ->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
