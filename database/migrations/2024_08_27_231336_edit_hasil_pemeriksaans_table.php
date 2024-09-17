<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hasil_pemeriksaans', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_2_jenis_id')->default(null)->nullable();
            $table->foreign('sub_2_jenis_id')->references('id')->on('sub_2_jenis_pemeriksaans')->restrictOnDelete()->cascadeOnUpdate();
            $table->dropForeign('hasil_pemeriksaans_sub_jenis_id_foreign');
            $table->dropColumn('sub_jenis_id');
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
