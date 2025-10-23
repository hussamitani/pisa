<?php

declare(strict_types=1);

namespace Database\Seeders\Production;

use App\Models\TicketType;
use App\Models\TicketTypeScheme;
use Illuminate\Database\Seeder;

class TicketTypeSchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Default Ticket Type Scheme
        $ticketTypeScheme = TicketTypeScheme::firstOrCreate(
            ['name' => 'Default Ticket Type Scheme'],
            ['description' => 'Default scheme with all ticket types']
        );

        // Attach all ticket types to the scheme
        $ticketTypes = TicketType::all();
        $position = 1;
        foreach ($ticketTypes as $type) {
            $ticketTypeScheme->ticketTypes()->syncWithoutDetaching([
                $type->id => ['position' => $position++],
            ]);
        }
    }
}
