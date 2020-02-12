<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->increments('id');
            // نوع مراجعه کننده
            $table->unsignedInteger('referral_type_id');
            $table->string('name');
            $table->string('lastname');
            $table->string('nationalId');
            $table->string('mobile');
            $table->unsignedInteger('gender_id');
            // واحد ملاقات شونده
            $table->unsignedInteger('department_id');
            // ملاقات شونده
            $table->unsignedInteger('user_id');
            // نوع ضمانت
            $table->unsignedInteger('warranty_id');
            $table->string('picture')->nullable();
            $table->string('organization')->nullable();
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('gender_id')
                    ->references('id')->on('genders')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('department_id')
                    ->references('id')->on('departments')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('warranty_id')
                    ->references('id')->on('warranties')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('referral_type_id')
                    ->references('id')->on('referral_types')
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
        Schema::dropIfExists('referrals');
    }
}
