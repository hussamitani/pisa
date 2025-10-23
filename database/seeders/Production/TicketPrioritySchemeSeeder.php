<?php

declare(strict_types=1);

namespace Database\Seeders\Production;

use App\Models\TicketPriority;
use App\Models\TicketPriorityScheme;
use Illuminate\Database\Seeder;

class TicketPrioritySchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Default Priority Scheme
        $priorityScheme = TicketPriorityScheme::firstOrCreate(
            ['name' => 'Default Priority Scheme'],
            ['description' => 'Default scheme with all priorities']
        );

        // Attach all priorities to the scheme
        $priorities = TicketPriority::all();
        $position = 1;
        foreach ($priorities as $priority) {
            $priorityScheme->priorities()->syncWithoutDetaching([
                $priority->id => ['position' => $position++],
            ]);
        }
    }
}
