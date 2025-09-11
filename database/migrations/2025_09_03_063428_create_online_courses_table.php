<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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

            // Price column with default 0
            $table->decimal('price', 10, 2)->default(0);

            $table->string('level')->nullable();
            $table->string('duration')->nullable();
            $table->string('language')->nullable();

            // New course_type column
            $table->enum('course_type', ['free', 'paid'])->default('free');

            // Foreign keys
            $table->foreignId('user_id');
            $table->foreignId('rating_id');
            $table->foreignId('category_id');
            $table->foreignId('created_by');
            $table->foreignId('updated_by');

            $table->timestamps();
        });

        // Optional: if you need to update existing rows after migration
        DB::table('online_courses')->whereNull('course_type')->update(['course_type' => 'free']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_courses');
    }
};
