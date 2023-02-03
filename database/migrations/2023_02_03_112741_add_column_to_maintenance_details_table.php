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
        Schema::table('maintenance_details', function (Blueprint $table) {
            $table->bigInteger('equipment_id')->nullable();
            $table->bigInteger('maintenance_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maintenance_details', function (Blueprint $table) {
            $table->dropColumn('equipment_id');
            $table->dropColumn('maintenance_id');
        });
    }
};
