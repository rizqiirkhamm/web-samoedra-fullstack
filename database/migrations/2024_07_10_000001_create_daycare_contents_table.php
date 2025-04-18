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
        Schema::create('daycare_contents', function (Blueprint $table) {
            $table->id();
            $table->string('banner_type')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('banner_video')->nullable();
            $table->string('kelebihan_daycare')->nullable();
            $table->string('about_daycare_title')->nullable();
            $table->text('about_daycare_description')->nullable();
            $table->json('about_daycare_details')->nullable();
            $table->string('about_caregiver_title')->nullable();
            $table->text('about_caregiver_description')->nullable();
            $table->text('program_description')->nullable();
            $table->string('program_image')->nullable();
            $table->json('program_points')->nullable();
            $table->json('facilities')->nullable();
            $table->json('pricelist')->nullable();
            $table->json('activities')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daycare_contents');
    }
};
