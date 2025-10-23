<?php

declare(strict_types=1);

namespace Database\Seeders\Production;

use App\Models\TicketLinkType;
use Illuminate\Database\Seeder;

class TicketLinkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $linkTypes = [
            [
                'name' => 'blocks',
                'inward_description' => 'is blocked by',
                'outward_description' => 'blocks',
                'is_system' => true,
                'is_hierarchical' => false,
            ],
            [
                'name' => 'clones',
                'inward_description' => 'is cloned by',
                'outward_description' => 'clones',
                'is_system' => true,
                'is_hierarchical' => false,
            ],
            [
                'name' => 'duplicates',
                'inward_description' => 'is duplicated by',
                'outward_description' => 'duplicates',
                'is_system' => true,
                'is_hierarchical' => false,
            ],
            [
                'name' => 'relates',
                'inward_description' => 'relates to',
                'outward_description' => 'relates to',
                'is_system' => true,
                'is_hierarchical' => false,
            ],
            [
                'name' => 'parent-child',
                'inward_description' => 'is child of',
                'outward_description' => 'is parent of',
                'is_system' => true,
                'is_hierarchical' => true,
            ],
            [
                'name' => 'epic',
                'inward_description' => 'belongs to epic',
                'outward_description' => 'has',
                'is_system' => true,
                'is_hierarchical' => true,
            ],
        ];

        foreach ($linkTypes as $linkType) {
            TicketLinkType::firstOrCreate(
                ['name' => $linkType['name']],
                $linkType
            );
        }
    }
}
