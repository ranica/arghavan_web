    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->unsignedInteger('room_count');
            $table->unsignedInteger('floor_count');
            $table->unsignedInteger('building_type_id');
            $table->unsignedInteger('block_id')->nullable();
            $table->json('extra');
            $table->softDeletes();


            $table->foreign('building_type_id')
                    ->references('id')
                    ->on('building_types')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('block_id')
                    ->references('id')
                    ->on('blocks')
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
        Schema::dropIfExists('buildings');
    }
}
