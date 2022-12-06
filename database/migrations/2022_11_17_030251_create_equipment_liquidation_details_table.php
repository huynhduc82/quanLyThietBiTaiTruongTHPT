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
        Schema::create('equipment_liquidation_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('equipment_liquidation_id');
            $table->bigInteger('type_of_equipment_id');
            $table->bigInteger('quantity')->unsigned();
            $table->string('liquidation_reason');
            $table->string('liquidation_method');
            $table->bigInteger('created_by')->nullable()->unsigned();
            $table->bigInteger('updated_by')->nullable()->unsigned();
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
        Schema::dropIfExists('equipment_liquidation_details');
    }
};
