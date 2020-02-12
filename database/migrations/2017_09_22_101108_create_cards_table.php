<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cdn')->unique();
            $table->date('startDate');
            $table->date('endDate');
            $table->boolean('state')->default(false);
            $table->unsignedinteger('cardtype_id');
            $table->unsignedinteger('group_id')->nullable();
            $table->unsignedinteger('user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('cardtype_id')
                    ->references('id')->on('cardtypes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('group_id')
                    ->references('id')->on('groups')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('user_id')
                    ->references('id')->on('users')
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
        Schema::dropIfExists('cards');
    }
}
