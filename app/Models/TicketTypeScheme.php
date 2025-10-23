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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TicketType> $ticketTypes
 * @property-read int|null $ticket_types_count
 *
 * @method static \Database\Factories\TicketTypeSchemeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketTypeScheme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketTypeScheme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketTypeScheme query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketTypeScheme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketTypeScheme whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketTypeScheme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketTypeScheme whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketTypeScheme whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class TicketTypeScheme extends Model
{
    /** @use HasFactory<\Database\Factories\TicketTypeSchemeFactory> */
    use HasFactory;

    protected $table = 'ticket_type_schemes';

    protected $fillable = [
        'name',
        'description',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'ticket_type_scheme_id');
    }

    public function ticketTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            TicketType::class,
            'ticket_type_scheme_types',
            'ticket_type_scheme_id',
            'ticket_type_id'
        )
            ->withPivot('position')
            ->withTimestamps()
            ->orderByPivot('position');
    }
}
