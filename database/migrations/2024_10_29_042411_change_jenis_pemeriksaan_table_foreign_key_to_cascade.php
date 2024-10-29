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
        Schema::table('hasil_pemeriksaans', function (Blueprint $table) {
            $table->dropForeign('hasil_pemeriksaans_jenis_id_foreign');
            $table->dropForeign('hasil_pemeriksaans_pemeriksaan_id_foreign');
            $table->dropForeign('hasil_pemeriksaans_sub_2_jenis_id_foreign');
            $table->dropForeign('hasil_pemeriksaans_sub_jenis_id_foreign');

            $table->foreign('pemeriksaan_id')->references('id')->on('hasil_pemeriksaans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('sub_2_jenis_id')->references('id')->on('sub_2_jenis_pemeriksaans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("sub_jenis_id")->references("id")->on("sub_jenis_pemeriksaans")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign("jenis_id")->references("id")->on("jenis_pemeriksaans")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_pemeriksaans', function (Blueprint $table) {
            //
        });
    }
};
