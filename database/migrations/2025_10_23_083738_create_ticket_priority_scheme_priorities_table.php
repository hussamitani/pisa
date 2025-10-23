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
        Schema::create('ticket_priority_scheme_priorities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_priority_scheme_id');
            $table->unsignedBigInteger('ticket_priority_id');
            $table->integer('position')->default(0);
            $table->timestamps();

            $table->unique(['ticket_priority_scheme_id', 'ticket_priority_id'], 'tpsp_unique');
            $table->index('ticket_priority_scheme_id', 'tpsp_scheme_idx');

            $table->foreign('ticket_priority_scheme_id', 'tpsp_scheme_fk')
                ->references('id')
                ->on('ticket_priority_schemes')
                ->cascadeOnDelete();

            $table->foreign('ticket_priority_id', 'tpsp_priority_fk')
                ->references('id')
                ->on('ticket_priorities')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_priority_scheme_priorities');
    }
};
