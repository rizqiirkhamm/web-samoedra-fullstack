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
        Schema::create('statistiks', function (Blueprint $table) {
            $table->id();
            $table->integer('daycare')->default(0);
            $table->string('daycare_title')->nullable();
            $table->text('daycare_description')->nullable();
            $table->integer('bermain')->default(0);
            $table->string('bermain_title')->nullable();
            $table->text('bermain_description')->nullable();
            $table->integer('bimbel')->default(0);
            $table->string('bimbel_title')->nullable();
            $table->text('bimbel_description')->nullable();
            $table->integer('stimulasi')->default(0);
            $table->string('stimulasi_title')->nullable();
            $table->text('stimulasi_description')->nullable();
            $table->integer('event')->default(0);
            $table->string('event_title')->nullable();
            $table->text('event_description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistiks');
    }
};
