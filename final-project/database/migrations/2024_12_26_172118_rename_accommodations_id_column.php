<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAccommodationsIdColumn extends Migration
{
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->renameColumn('id', 'accommodation_id');
        });
    }

    public function down()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->renameColumn('accommodation_id', 'id');
        });
    }
}

