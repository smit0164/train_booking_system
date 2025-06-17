<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trains_per_station_schedule',function (Blueprint $table){
            $table->id();
            $table->foreignId('train_id')->constrained('trains')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('station_id')->constrained('stations_info')->onUpdate('cascade')->onDelete('cascade');
            $table->string('arrival_time');
            $table->string('departure_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
