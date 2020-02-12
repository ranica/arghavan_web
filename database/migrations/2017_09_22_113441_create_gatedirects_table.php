<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatedirectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gatedirects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            // برای ثبت دستی تردد لازم است فیلدهایی در منوی کاربر ظاهر شود که نیاز است.
            // بنابراین فیلد type افزوده شد.
            $table->integer('type'); 
            $table->softDeletes();
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gatedirects');
    }
}
