<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('online_courses', function (Blueprint $table) {
            // Add new column after 'language'
            $table->enum('course_type', ['free', 'paid'])->default('free')->after('language');

            // Update existing column default
            $table->decimal('price', 10, 2)->default(0)->change();
        });

        // Update existing rows: set course_type to 'free' if null
        DB::table('online_courses')->whereNull('course_type')->update(['course_type' => 'free']);
    }

    public function down(): void
    {
        Schema::table('online_courses', function (Blueprint $table) {
            $table->dropColumn('course_type');
            $table->decimal('price', 10, 2)->nullable()->change();
        });
    }
};
