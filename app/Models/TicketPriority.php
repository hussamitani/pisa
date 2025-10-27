<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $color
 * @property string $icon
 * @property int $is_default
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TicketPriorityScheme> $schemes
 * @property-read int|null $schemes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket> $tickets
 * @property-read int|null $tickets_count
 *
 * @method static \Database\Factories\TicketPriorityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriority withoutTrashed()
 *
 * @mixin \Eloquent
 */
class TicketPriority extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'color', 'icon', 'is_default',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'priority_id', 'id')->withTrashed();
    }

    public function schemes(): BelongsToMany
    {
        return $this->belongsToMany(
            TicketPriorityScheme::class,
            'ticket_priority_scheme_priorities',
            'ticket_priority_id',
            'ticket_priority_scheme_id'
        )
            ->withPivot('position')
            ->withTimestamps()
            ->orderByPivot('position');
    }
}
