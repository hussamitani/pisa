<?php

declare(strict_types=1);

namespace App\Models;

use App\Enum\TicketStatusCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property TicketStatusCategory $category
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TicketStatusScheme> $schemes
 * @property-read int|null $schemes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket> $tickets
 * @property-read int|null $tickets_count
 *
 * @method static \Database\Factories\TicketStatusFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatus whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatus withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatus withoutTrashed()
 *
 * @mixin \Eloquent
 */
class TicketStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'color', 'is_default', 'order',
    ];

    protected $casts = [
        'category' => TicketStatusCategory::class,
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'status_id', 'id');
    }

    public function schemes(): BelongsToMany
    {
        return $this->belongsToMany(
            TicketStatusScheme::class,
            'ticket_status_scheme_statuses',
            'ticket_status_id',
            'ticket_status_scheme_id'
        )
            ->withPivot(['position', 'is_initial'])
            ->withTimestamps()
            ->orderByPivot('position');
    }
}
