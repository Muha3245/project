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
        Schema::create('highlight_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('highlight_id')->constrained()->onDelete('cascade'); // Foreign key
            $table->string('image'); // Additional image
            $table->string('name')->nullable(); // Optional name
            $table->text('detail')->nullable(); // Optional detail
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('highlight_images');
    }
};
