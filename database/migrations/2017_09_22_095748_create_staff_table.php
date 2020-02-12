<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('contract_id');
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('contractor_id')->nullable();

           

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('contract_id')
                  ->references('id')->on('contracts')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

          	$table->foreign('department_id')
                  ->references('id')->on('departments')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
           $table->foreign('company_id')
                      ->references('id')->on('companies')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');

            $table->foreign('contractor_id')
                      ->references('id')->on('contractors')
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
        Schema::dropIfExists('staff');
    }
}
