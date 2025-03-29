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
        Schema::create('stimulasi', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('phone');
            $table->integer('height'); // Tinggi Badan (cm)
            $table->integer('weight'); // Berat Badan (gr)
            $table->string('gender');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->text('address');
            $table->string('child_phone')->nullable();
            $table->integer('child_order');
            $table->string('religion');

            // Data Orang Tua
            $table->string('father_name');
            $table->integer('father_age');
            $table->text('father_education');
            $table->text('father_occupation');
            $table->string('mother_name');
            $table->integer('mother_age');
            $table->text('mother_education');
            $table->text('mother_occupation');

            // Informasi Tambahan
            $table->string('student_photo');
            $table->string('payment_proof');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('need_socks')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stimulasi');
    }
};
