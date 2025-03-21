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
        Schema::create('bimbel', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');  // Data umum
            $table->string('phone'); // Data umum
            $table->enum('bimbel_type', ['online', 'offline']);
            $table->enum('service_type', [
                'bimbel_calistung',
                'bimbel_sd',
                'bimbel_mengaji',
                'bimbel_coding',
                'bimbel_english',
                'bimbel_arabic',
                'bimbel_islam',
                'bimbel_art',
                'bimbel_computer'
            ]);
            $table->enum('gender', ['L', 'P']);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->boolean('has_school_history');
            $table->string('school_name')->nullable();
            $table->enum('religion', ['islam', 'kristen', 'protestan', 'hindu', 'budha']);
            $table->text('address');
            $table->integer('child_order'); // anak ke-
            $table->string('child_phone')->nullable();

            // Data Ayah
            $table->string('father_name');
            $table->integer('father_age');
            $table->text('father_education');
            $table->text('father_occupation');

            // Data Ibu
            $table->string('mother_name');
            $table->integer('mother_age');
            $table->text('mother_education');
            $table->text('mother_occupation');

            // File uploads
            $table->string('student_photo');
            $table->string('payment_proof');

            // Tambahan field untuk jadwal
            $table->date('start_date');
            $table->string('day');
            $table->integer('total_meetings'); // Ganti meeting_count dengan total_meetings
            $table->enum('status', ['active', 'inactive', 'completed'])->default('inactive');

            // Tambahkan sebelum timestamps
            $table->boolean('need_socks')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbel');
    }
};
