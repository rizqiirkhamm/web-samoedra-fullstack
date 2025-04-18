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
        Schema::table('articles', function (Blueprint $table) {
            // Hapus kolom category yang lama jika ada
            if (Schema::hasColumn('articles', 'category')) {
                $table->dropColumn('category');
            }

            // Tambah kolom category_id
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('events')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            // Kembalikan kolom category yang lama
            $table->string('category')->nullable();
        });
    }
};
