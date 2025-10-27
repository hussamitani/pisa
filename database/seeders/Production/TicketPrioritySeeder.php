<?php

declare(strict_types=1);

namespace Database\Seeders\Production;

use App\Models\TicketPriority;
use Illuminate\Database\Seeder;

class TicketPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = [
            ['name' => 'Highest', 'color' => '#CC0000', 'icon' => 'heroicon-o-chevron-double-up'],
            ['name' => 'High', 'color' => '#FF5630', 'icon' => 'heroicon-o-chevron-up'],
            ['name' => 'Medium', 'color' => '#FF991F', 'icon' => 'heroicon-o-equals'],
            ['name' => 'Low', 'color' => '#36B37E', 'icon' => 'heroicon-o-chevron-down'],
            ['name' => 'Lowest', 'color' => '#57D9A3', 'icon' => 'heroicon-o-chevron-double-down'],
        ];

        foreach ($priorities as $priority) {
            TicketPriority::firstOrCreate(
                ['name' => $priority['name']],
                $priority
            );
        }
    }
}
