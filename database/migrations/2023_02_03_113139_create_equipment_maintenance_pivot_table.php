<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_maintenance_pivot', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('equipment_id')->unsigned()->index();
            $table->foreign('equipment_id')->references('id')->on('equipment')
                ->onDelete('cascade');

            $table->integer('maintenance_id')->unsigned()->index();
            $table->foreign('maintenance_id')->references('id')->on('maintenance_details')
                ->onDelete('cascade');

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
        Schema::dropIfExists('equipment_maintenance_pivot');
    }
};
