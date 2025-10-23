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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TicketPriority> $priorities
 * @property-read int|null $priorities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 *
 * @method static \Database\Factories\TicketPrioritySchemeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriorityScheme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriorityScheme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriorityScheme query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriorityScheme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriorityScheme whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriorityScheme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriorityScheme whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPriorityScheme whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class TicketPriorityScheme extends Model
{
    /** @use HasFactory<\Database\Factories\TicketPrioritySchemeFactory> */
    use HasFactory;

    protected $table = 'ticket_priority_schemes';

    protected $fillable = [
        'name',
        'description',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'ticket_priority_scheme_id');
    }

    public function priorities(): BelongsToMany
    {
        return $this->belongsToMany(
            TicketPriority::class,
            'ticket_priority_scheme_priorities',
            'ticket_priority_scheme_id',
            'ticket_priority_id'
        )
            ->withPivot('position')
            ->withTimestamps()
            ->orderByPivot('position');
    }
}
