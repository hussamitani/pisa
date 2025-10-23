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
        Schema::create('ticket_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_ticket_id')->constrained('tickets')->cascadeOnDelete();
            $table->foreignId('target_ticket_id')->constrained('tickets')->cascadeOnDelete();
            $table->foreignId('ticket_link_type_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->index(['source_ticket_id', 'ticket_link_type_id']);
            $table->index(['target_ticket_id', 'ticket_link_type_id']);
            $table->unique(['source_ticket_id', 'target_ticket_id', 'ticket_link_type_id'], 'unique_ticket_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_links');
    }
};
