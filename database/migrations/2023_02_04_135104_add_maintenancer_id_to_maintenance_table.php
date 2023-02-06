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
        Schema::table('maintenance', function (Blueprint $table) {
            $table->bigInteger('maintenancer_id')->nullable();
            $table->timestamp('maintenance_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maintenance', function (Blueprint $table) {
            $table->dropColumn('maintenancer_id')->nullable();
            $table->dropColumn('maintenance_time')->nullable();
        });
    }
};
