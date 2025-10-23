<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $source_ticket_id
 * @property int $target_ticket_id
 * @property int $ticket_link_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $inward_description
 * @property-read string $outward_description
 * @property-read \App\Models\TicketLinkType $linkType
 * @property-read \App\Models\Ticket $sourceTicket
 * @property-read \App\Models\Ticket $targetTicket
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLink query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLink whereSourceTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLink whereTargetTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLink whereTicketLinkTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketLink whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class TicketLink extends Model
{
    protected $fillable = [
        'source_ticket_id',
        'target_ticket_id',
        'ticket_link_type_id',
    ];

    // Source ticket (the "from" side of the link)
    public function sourceTicket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'source_ticket_id');
    }

    // Target ticket (the "to" side of the link)
    public function targetTicket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'target_ticket_id');
    }

    // Link type
    public function linkType(): BelongsTo
    {
        return $this->belongsTo(TicketLinkType::class, 'ticket_link_type_id');
    }

    // Get the description for this link from the source perspective
    public function getOutwardDescriptionAttribute(): string
    {
        return $this->linkType->outward_description;
    }

    // Get the description for this link from the target perspective
    public function getInwardDescriptionAttribute(): string
    {
        return $this->linkType->inward_description;
    }

    // Check if this is a hierarchical link (parent-child, epic, etc.)
    public function isHierarchical(): bool
    {
        return $this->linkType->is_hierarchical ?? false;
    }
}
