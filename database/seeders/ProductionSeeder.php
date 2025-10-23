<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Seeders\Production\TicketPrioritySchemeSeeder;
use Database\Seeders\Production\TicketPrioritySeeder;
use Database\Seeders\Production\TicketStatusSchemeSeeder;
use Database\Seeders\Production\TicketStatusSeeder;
use Database\Seeders\Production\TicketTypeSchemeSeeder;
use Database\Seeders\Production\TicketTypeSeeder;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TicketTypeSeeder::class,
            TicketTypeSchemeSeeder::class,

            TicketPrioritySeeder::class,
            TicketPrioritySchemeSeeder::class,

            TicketStatusSeeder::class,
            TicketStatusSchemeSeeder::class,
        ]);
    }
}
