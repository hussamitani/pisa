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
                'name' => 'Blocks',
                'inward_description' => 'is blocked by',
                'outward_description' => 'blocks',
                'is_system' => true,
                'is_hierarchical' => false,
            ],
            [
                'name' => 'Clones',
                'inward_description' => 'is cloned by',
                'outward_description' => 'clones',
                'is_system' => true,
                'is_hierarchical' => false,
            ],
            [
                'name' => 'Duplicates',
                'inward_description' => 'is duplicated by',
                'outward_description' => 'duplicates',
                'is_system' => true,
                'is_hierarchical' => false,
            ],
            [
                'name' => 'Relates To',
                'inward_description' => 'relates to',
                'outward_description' => 'relates to',
                'is_system' => true,
                'is_hierarchical' => false,
            ],
            [
                'name' => 'Parent-Child',
                'inward_description' => 'is child of',
                'outward_description' => 'is parent of',
                'is_system' => true,
                'is_hierarchical' => true,
            ],
            [
                'name' => 'Epic',
                'inward_description' => 'belongs to epic',
                'outward_description' => 'contains',
                'is_system' => true,
                'is_hierarchical' => true,
            ],
        ];

        foreach ($linkTypes as $linkType) {
            TicketLinkType::updateOrCreate(
                ['name' => $linkType['name']],
                $linkType
            );
        }
    }
}
