<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('room');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guests');
            $table->string('status')->default('processing');
            $table->string('reservation_id')->unique(); 
            $table->decimal('total_price', 10, 2);
            $table->json('amenities')->nullable(); 
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
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('reservation_amenity');
        
    }
}
