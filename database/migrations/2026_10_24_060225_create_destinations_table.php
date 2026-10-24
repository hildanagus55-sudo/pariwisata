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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('region');
            $table->string('location');
            $table->string('category'); // Pantai, Pegunungan, Budaya, Alam
            $table->decimal('rating', 3, 2)->default(4.90);
            $table->unsignedInteger('reviews_count')->default(100);
            $table->unsignedBigInteger('price');
            $table->string('duration');
            $table->string('best_time');
            $table->text('image');
            $table->text('description');
            $table->json('highlights')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
