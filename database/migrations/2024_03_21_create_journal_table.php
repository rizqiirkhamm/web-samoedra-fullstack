<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bimbel_id')->constrained('bimbel')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('nama_guru');
            $table->string('pelajaran');
            $table->text('pembahasan');
            $table->integer('pertemuan_ke');
            $table->integer('periode_ke');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal');
    }
};