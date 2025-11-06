<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Znck\Eloquent\Relations\BelongsToThrough;

/**
 * @property int $id
 * @property string $name
 * @property string $ticket_prefix
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $ticket_type_scheme_id
 * @property int $ticket_priority_scheme_id
 * @property int $ticket_status_scheme_id
 * @property-read mixed $contributors
 * @property-read mixed $cover
 * @property-read mixed $current_sprint
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $members
 * @property-read int|null $members_count
 * @property-read mixed $next_sprint
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sprint> $sprints
 * @property-read int|null $sprints_count
 * @property-read \App\Models\TicketPriorityScheme $ticketPriorityScheme
 * @property-read \App\Models\TicketStatusScheme $ticketStatusScheme
 * @property-read \App\Models\TicketTypeScheme $ticketTypeScheme
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket> $tickets
 * @property-read int|null $tickets_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 *
 * @method static \Database\Factories\ProjectFactory factory($count = null, $state = [])
 * @method static Builder<static>|Project newModelQuery()
 * @method static Builder<static>|Project newQuery()
 * @method static Builder<static>|Project onlyTrashed()
 * @method static Builder<static>|Project query()
 * @method static Builder<static>|Project whereCreatedAt($value)
 * @method static Builder<static>|Project whereDeletedAt($value)
 * @method static Builder<static>|Project whereDescription($value)
 * @method static Builder<static>|Project whereId($value)
 * @method static Builder<static>|Project whereName($value)
 * @method static Builder<static>|Project whereTicketPrefix($value)
 * @method static Builder<static>|Project whereTicketPrioritySchemeId($value)
 * @method static Builder<static>|Project whereTicketStatusSchemeId($value)
 * @method static Builder<static>|Project whereTicketTypeSchemeId($value)
 * @method static Builder<static>|Project whereUpdatedAt($value)
 * @method static Builder<static>|Project withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|Project withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'name',
        'description',
        'ticket_prefix',
        'ticket_type_scheme_id',
        'ticket_priority_scheme_id',
        'ticket_status_scheme_id',
    ];

    protected $appends = [
        'cover',
    ];

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(
            Team::class,
            'team_projects',
        );
    }

    public function users(): BelongsToThrough
    {
        return $this->belongsToThrough(
            User::class,
            [
                TeamUser::class,
                Team::class,
                TeamProject::class,
                Project::class,
            ],
            'id',
            null,
            [
                TeamUser::class => 'id',
                Team::class => 'team_id',
                TeamProject::class => 'id',
                Project::class => 'id',
            ],
            [
                TeamUser::class => 'team_id',
                Team::class => 'id',
                TeamProject::class => 'project_id',
                Project::class => 'id',
            ]
        );
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'project_id', 'id');
    }

    public function sprints(): HasMany
    {
        return $this->hasMany(Sprint::class, 'project_id', 'id');
    }

    public function ticketTypeScheme(): BelongsTo
    {
        return $this->belongsTo(TicketTypeScheme::class, 'ticket_type_scheme_id');
    }

    public function ticketPriorityScheme(): BelongsTo
    {
        return $this->belongsTo(TicketPriorityScheme::class, 'ticket_priority_scheme_id');
    }

    public function ticketStatusScheme(): BelongsTo
    {
        return $this->belongsTo(TicketStatusScheme::class, 'ticket_status_scheme_id');
    }

    public function contributors(): Attribute
    {
        return new Attribute(
            get: function () {
                $users = $this->users;
                $users->push($this->owner);

                return $users->unique('id');
            }
        );
    }

    public function cover(): Attribute
    {
        return new Attribute(
            get: fn () => $this->media('cover')?->first()?->getFullUrl()
                ??
                'https://ui-avatars.com/api/?background=3f84f3&color=ffffff&name='.$this->name
        );
    }

    public function currentSprint(): Attribute
    {
        return new Attribute(
            get: fn () => $this->sprints()
                ->whereNotNull('started_at')
                ->whereNull('ended_at')
                ->first()
        );
    }

    public function nextSprint(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->currentSprint) {
                    return $this->sprints()
                        ->whereNull('started_at')
                        ->whereNull('ended_at')
                        ->where('starts_at', '>=', $this->currentSprint->ends_at)
                        ->orderBy('starts_at')
                        ->first();
                }

                return null;
            }
        );
    }
}
