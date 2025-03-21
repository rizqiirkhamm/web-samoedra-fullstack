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
    { Schema::create('permissions', function (Blueprint $table) { // Gunakan 'permissions' (jamak)
        $table->id(); // INT, PRIMARY KEY, AUTO_INCREMENT
        $table->string('name', 255)->nullable(); // VARCHAR(255), NULL
        $table->string('slug', 255)->nullable(); // VARCHAR(255), NULL
        $table->integer('groupby')->default(0); // INT, Default 0
        $table->timestamps(); // created_at & updated_at
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
