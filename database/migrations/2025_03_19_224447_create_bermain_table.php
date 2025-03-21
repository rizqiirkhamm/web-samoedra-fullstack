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
        Schema::create('bermain', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('phone');
            $table->integer('duration'); // Durasi dalam jam
            $table->dateTime('start_datetime'); // Menggabungkan date dan time
            $table->dateTime('end_datetime')->nullable();
            $table->string('day'); // Hari akan dihitung dari start_datetime
            $table->string('payment_proof');
            $table->boolean('need_socks')->default(false);
            $table->enum('status', ['waiting', 'playing', 'finished'])->default('waiting');
            $table->integer('remaining_time')->nullable(); // dalam detik
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bermain');
    }
};
