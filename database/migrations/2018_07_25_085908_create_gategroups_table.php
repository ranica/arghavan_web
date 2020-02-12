o<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGategroupsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('gategroups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Migrate gatedevice _ gategroup Pivote
         */
        Schema::create('gatedevice_gategroup', function (Blueprint $table) {
            $table->integer('gatedevice_id')->unsigned();
            $table->integer('gategroup_id')->unsigned();

            $table->foreign('gatedevice_id')
                    ->references('id')
                    ->on('gatedevices')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('gategroup_id')
                    ->references('id')
                    ->on('gategroups')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->primary(['gatedevice_id', 'gategroup_id']);
        });

         /**
         * Migrate Gate Group and User
         */
        Schema::create('gategroup_user', function (Blueprint $table) {
            $table->integer('gategroup_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('gategroup_id')
                    ->references('id')
                    ->on('gategroups')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->primary(['gategroup_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gategroups');
        Schema::dropIfExists('gatedevice_gategroup');
    }
}
