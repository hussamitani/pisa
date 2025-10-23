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
        Schema::create('ticket_link_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('inward_description');
            $table->string('outward_description');
            $table->boolean('is_system')->default(false);
            $table->boolean('is_hierarchical')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_link_types');
    }
};
