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
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('ticket_type_scheme_id')
                ->constrained('ticket_type_schemes')
                ->cascadeOnDelete();

            $table->foreignId('ticket_priority_scheme_id')
                ->constrained('ticket_priority_schemes')
                ->cascadeOnDelete();

            $table->foreignId('ticket_status_scheme_id')
                ->constrained('ticket_status_schemes')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['ticket_type_scheme_id']);
            $table->dropForeign(['ticket_priority_scheme_id']);
            $table->dropForeign(['ticket_status_scheme_id']);

            $table->dropColumn([
                'ticket_type_scheme_id',
                'ticket_priority_scheme_id',
                'ticket_status_scheme_id',
            ]);
        });
    }
};
