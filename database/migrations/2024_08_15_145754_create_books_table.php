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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn')->unique();
            $table->string('authors');
            $table->string('publisher');
            $table->string('edition');
            $table->string('cover_art')->nullable();
            
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Ensures category_id is an unsignedBigInteger and references categories(id)
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ensures user_id is an unsignedBigInteger and references users(id)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
