<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("hasil_pemeriksaans", function (Blueprint $table) {
            $table->unsignedBigInteger("sub_jenis_id")->nullable();
            $table->foreign("sub_jenis_id")->references("id")->on("sub_jenis_pemeriksaans")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedBigInteger("jenis_id")->nullable();
            $table->foreign("jenis_id")->references("id")->on("jenis_pemeriksaans")
                ->cascadeOnUpdate()
                ->restrictOnDelete();
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
