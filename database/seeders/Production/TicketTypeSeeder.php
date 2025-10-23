<?php

declare(strict_types=1);

namespace Database\Seeders\Production;

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Epic', 'icon' => 'heroicon-o-bolt'],
            ['name' => 'Story', 'icon' => 'heroicon-o-book-open'],
            ['name' => 'Task', 'icon' => 'heroicon-o-check-circle'],
            ['name' => 'Bug', 'icon' => 'heroicon-o-bug-ant'],
            ['name' => 'Subtask', 'icon' => 'heroicon-o-list-bullet'],
        ];

        foreach ($types as $type) {
            TicketType::firstOrCreate(
                ['name' => $type['name']],
                $type
            );
        }
    }
}
