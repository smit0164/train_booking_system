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
        Schema::create('trains_class', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('train_id')->constrained(table:'trains')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('total_count');
            $table->integer('available_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trains_class');
    }
};
