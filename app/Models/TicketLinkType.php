<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $inward_description
 * @property string $outward_description
 * @property bool $is_system
 * @property bool $is_hierarchical
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $formatted_description
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TicketLink> $links
 * @property-read int|null $links_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLinkType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLinkType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLinkType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLinkType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLinkType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLinkType whereInwardDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLinkType whereIsHierarchical($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLinkType whereIsSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLinkType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLinkType whereOutwardDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLinkType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class TicketLinkType extends Model
{
    protected $fillable = [
        'name',
        'inward_description',
        'outward_description',
        'is_system',
        'is_hierarchical',
    ];

    protected $casts = [
        'is_system' => 'boolean',
        'is_hierarchical' => 'boolean',
    ];

    // All links of this type
    public function links(): HasMany
    {
        return $this->hasMany(TicketLink::class, 'ticket_link_type_id');
    }

    // Check if this is a system link type (can't be deleted)
    public function isSystem(): bool
    {
        return $this->is_system;
    }

    // Check if this is a hierarchical link type
    public function isHierarchical(): bool
    {
        return $this->is_hierarchical;
    }

    // Get formatted description for UI
    public function getFormattedDescriptionAttribute(): string
    {
        return "{$this->outward_description} / {$this->inward_description}";
    }
}
