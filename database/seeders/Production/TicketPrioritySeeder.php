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
            ['name' => 'Highest', 'color' => '#CC0000'],
            ['name' => 'High', 'color' => '#FF5630'],
            ['name' => 'Medium', 'color' => '#FF991F'],
            ['name' => 'Low', 'color' => '#36B37E'],
            ['name' => 'Lowest', 'color' => '#57D9A3'],
        ];

        foreach ($priorities as $priority) {
            TicketPriority::firstOrCreate(
                ['name' => $priority['name']],
                $priority
            );
        }
    }
}
