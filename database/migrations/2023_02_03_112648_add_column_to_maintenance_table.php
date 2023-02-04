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
            $table->bigInteger('user_id')->nullable();
            $table->timestamp('maintenance_day')->nullable();
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
            $table->dropColumn('user_id');
            $table->dropColumn('maintenance_day');
        });
    }
};
