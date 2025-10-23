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
        Schema::create('ticket_status_scheme_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_status_scheme_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ticket_status_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_initial')->default(false);
            $table->integer('position')->default(0);
            $table->timestamps();

            $table->unique(['ticket_status_scheme_id', 'ticket_status_id'], 'scheme_status_unique');
            $table->index('ticket_status_scheme_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_status_scheme_statuses');
    }
};
