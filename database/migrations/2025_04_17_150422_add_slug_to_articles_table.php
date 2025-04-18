<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        // Buat slug untuk artikel yang sudah ada
        $articles = DB::table('articles')->whereNull('slug')->get();
        foreach ($articles as $article) {
            DB::table('articles')
                ->where('id', $article->id)
                ->update(['slug' => Str::slug($article->title)]);
        }

        // Setelah semua slug dibuat, tambahkan unique constraint
        Schema::table('articles', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
