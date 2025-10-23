<?php

declare(strict_types=1);

namespace Database\Seeders\Production;

use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Backlog', 'category' => 'to_do'],
            ['name' => 'To Do', 'category' => 'to_do'],
            ['name' => 'In Progress', 'category' => 'in_progress'],
            ['name' => 'In Review', 'category' => 'in_progress'],
            ['name' => 'Done', 'category' => 'done'],
            ['name' => 'Cancelled', 'category' => 'done'],
        ];

        foreach ($statuses as $status) {
            TicketStatus::firstOrCreate(
                ['name' => $status['name']],
                $status
            );
        }
    }
}
