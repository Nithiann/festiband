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
            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('festival_id');
            $table->string('set_name')->nullable(true);
            $table->dateTime('start_time')->nullable(true);
            $table->dateTime('end_time')->nullable(true);
            $table->timestamps();

            $table->foreign('artist_id')->references('id')->on('artists');
            $table->foreign('festival_id')->references('id')->on('festivals');
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
