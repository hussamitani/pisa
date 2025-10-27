<?php

declare(strict_types=1);

namespace Database\Seeders\Production;

use App\Enum\TicketStatusCategory;
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
            ['name' => 'Backlog', 'category' => TicketStatusCategory::TODO],
            ['name' => 'To Do', 'category' => TicketStatusCategory::TODO],
            ['name' => 'In Progress', 'category' => TicketStatusCategory::IN_PROGRESS],
            ['name' => 'In Review', 'category' => TicketStatusCategory::IN_PROGRESS],
            ['name' => 'Done', 'category' => TicketStatusCategory::DONE],
            ['name' => 'Cancelled', 'category' => TicketStatusCategory::DONE],
        ];

        foreach ($statuses as $status) {
            TicketStatus::firstOrCreate(
                ['name' => $status['name']],
                $status
            );
        }
    }
}
