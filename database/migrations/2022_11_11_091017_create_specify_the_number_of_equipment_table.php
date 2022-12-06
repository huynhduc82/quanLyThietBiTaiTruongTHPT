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
        Schema::create('specify_the_number_of_equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('equipment_id');
            $table->bigInteger('course_details_id');
            $table->integer('quantity')->unsigned()->default(0);
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
        Schema::dropIfExists('specify_the_number_of_equipment');
    }
};
