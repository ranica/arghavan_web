<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('value');
            $table->unsignedInteger('contact_type_id');
            $table->unsignedInteger('building_id');
            $table->softDeletes();

            $table->foreign('contact_type_id')
                    ->references('id')
                    ->on('contact_types')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('building_id')
                    ->references('id')
                    ->on('buildings')
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
        Schema::dropIfExists('building_contacts');
    }
}
