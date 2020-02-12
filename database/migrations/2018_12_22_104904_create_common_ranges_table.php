<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommonRangesTable extends Migration
{
    /**
     * Run the migrations.
     * تعریف بازه متداول برا یگزارش گیری
     * @return void
     */
    public function up()
    {
        Schema::create('common_ranges', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('common_ranges');
    }
}
