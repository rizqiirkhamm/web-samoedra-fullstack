<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->string('name');
            $table->integer('age');
            $table->string('phone');
            $table->boolean('need_socks')->default(false);
            $table->string('parent_name');
            $table->text('address');
            $table->string('social_media');
            $table->string('payment_proof');
            $table->string('source_info');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_registrations');
    }
};