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
            $table->string('banner_type')->default('image');
            $table->string('banner_image')->nullable();
            $table->string('banner_video')->nullable();
            $table->text('kelebihan_daycare');
            $table->string('about_daycare_title');
            $table->text('about_daycare_description');
            $table->json('about_daycare_details');
            $table->string('about_caregiver_title');
            $table->text('about_caregiver_description');
            $table->text('program_description');
            $table->string('program_image')->nullable();
            $table->json('program_points');
            $table->json('facilities');
            $table->json('pricelist');
            $table->json('activities');
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
