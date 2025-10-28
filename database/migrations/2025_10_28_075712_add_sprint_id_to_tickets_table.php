<?php

declare(strict_types=1);

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
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('sprint_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('sprint_position')->default(0);
            $table->integer('project_position')->default(0);
            $table->integer('story_points')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('sprint_id');
            $table->dropColumn('sprint_id');
            $table->dropColumn('sprint_position');
            $table->dropColumn('project_position');
            $table->dropColumn('story_points');
        });
    }
};
