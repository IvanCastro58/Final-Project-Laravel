<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyInReservations extends Migration
{
    public function up()
    {
        // Drop the existing foreign key constraint
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['accommodation_id']);
        });

        // Add new foreign key constraint
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign('accommodation_id')->references('accommodation_id')->on('accommodations')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Drop the foreign key
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['accommodation_id']);
        });

        // Revert to the old foreign key if necessary
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign('accommodation_id')->references('id')->on('accommodations')->onDelete('cascade');
        });
    }
}
