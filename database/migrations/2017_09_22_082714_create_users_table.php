<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('code');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('state')->default(false);
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('people_id')->nullable();
            $table->unsignedInteger('level_id')->nullable();
            $table->string('api_token')
                  ->nullable()
                  ->unique();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('group_id')
                    ->references('id')->on('groups')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('people_id')
                    ->references('id')->on('people')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('level_id')
                    ->references('id')->on('levels')
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
        Schema::dropIfExists('users');
    }
}
