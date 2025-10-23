<?php

declare(strict_types=1);

namespace Database\Seeders\Production;

use App\Models\TicketStatus;
use App\Models\TicketStatusScheme;
use Illuminate\Database\Seeder;

class TicketStatusSchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Default Status Scheme
        $statusScheme = TicketStatusScheme::firstOrCreate(
            ['name' => 'Default Status Scheme'],
            ['description' => 'Default scheme with basic workflow']
        );

        // Attach statuses to the scheme with proper ordering
        $statuses = TicketStatus::all();
        $position = 1;
        foreach ($statuses as $status) {
            $isInitial = $status->name === 'To Do'; // First status is initial

            $statusScheme->statuses()->syncWithoutDetaching([
                $status->id => [
                    'position' => $position++,
                    'is_initial' => $isInitial,
                ],
            ]);
        }
    }
}
