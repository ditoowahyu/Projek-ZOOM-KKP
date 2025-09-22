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
        Schema::create('perwira', function (Blueprint $table) {
            $table->id();
            $table->string('nama');         // nama perwira
            $table->string('nrp')->unique(); // NRP unik
            $table->string('no_hp')->nullable(); // nomor HP, boleh null
            $table->string('email')->unique(); // email unik
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perwira');
    }
};
