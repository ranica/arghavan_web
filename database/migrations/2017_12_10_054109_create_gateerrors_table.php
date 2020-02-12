<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGateerrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateerrors', function (Blueprint $table) {
            $table->increments('id');
            $table->text('error');
            $table->text('eSource');
            $table->text('eInnerException');
            $table->text('eStackTrace');
            $table->text('eTargetSite');
            $table->text('eTargetSiteName');
            $table->text('eTargetSiteModule');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gateerrors');
    }
}
