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
        Schema::create('sub_2_jenis_pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_jenis_pemeriksaan_id')->constrained();
            $table->string('name', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_2_jenis_pemeriksaans');
    }
};
