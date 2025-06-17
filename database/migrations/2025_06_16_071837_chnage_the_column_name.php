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
        Schema::table('trains',function(Blueprint $table){
           $table->renameColumn('route_id', 'route-id');
            $table->renameColumn('starting_time', 'start-time');
             $table->renameColumn('end_time', 'end-time');
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
