<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacation_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('vacation_type_id');
            $table->unsignedInteger('vacation_status_id');
            $table->text('subject');
            $table->date('begin_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->dateTime('begin_hour')->nullable();
            $table->dateTime('finish_hour')->nullable();
            $table->json('extra')->nullable();
            $table->dateTime('seen_at')->nullable();
            $table->dateTime('responsed_at')->nullable();
            //$table->unsignedInteger('responsed_user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('vacation_type_id')
                    ->references('id')->on('vacation_types')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('vacation_status_id')
                    ->references('id')->on('vacation_statuses')
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
        Schema::dropIfExists('vacation_requests');
    }
}
