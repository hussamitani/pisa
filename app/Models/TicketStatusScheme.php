<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TicketStatus> $statuses
 * @property-read int|null $statuses_count
 *
 * @method static \Database\Factories\TicketStatusSchemeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatusScheme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatusScheme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatusScheme query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatusScheme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatusScheme whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatusScheme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatusScheme whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketStatusScheme whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class TicketStatusScheme extends Model
{
    /** @use HasFactory<\Database\Factories\TicketStatusSchemeFactory> */
    use HasFactory;

    protected $table = 'ticket_status_schemes';

    protected $fillable = [
        'name',
        'description',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'ticket_status_scheme_id');
    }

    public function statuses(): BelongsToMany
    {
        return $this->belongsToMany(
            TicketStatus::class,
            'ticket_status_scheme_statuses',
            'ticket_status_scheme_id',
            'ticket_status_id'
        )
            ->withPivot(['position', 'is_initial'])
            ->withTimestamps()
            ->orderByPivot('position');
    }
}
