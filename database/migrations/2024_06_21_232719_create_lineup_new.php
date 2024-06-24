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
        Schema::create('lineup', function (Blueprint $table) {
            $table->id();
            $table->string('set_name')->nullable(true);
            $table->dateTime('start_time')->nullable(true);
            $table->dateTime('end_time')->nullable(true);
            $table->timestamps();
            $table->foreignId('artist_id')->constrained()->onDelete('cascade');
            $table->foreignId('festival_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lineup');
    }
};
