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
        Schema::create('online_courses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('level')->nullable();
            $table->string('duration')->nullable();
            $table->string('language')->nullable();

            // Foreign keys
            $table->foreignId('user_id');
            $table->foreignId('rating_id');
            $table->foreignId('category_id');
            $table->foreignId('created_by');
            $table->foreignId('updated_by');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_courses');
    }
};
