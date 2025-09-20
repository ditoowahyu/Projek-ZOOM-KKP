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
        Schema::create('zoom_schedules', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('meeting_id');
    $table->string('password')->nullable();
    $table->dateTime('schedule_time');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zoom_schedules');
    }
};
