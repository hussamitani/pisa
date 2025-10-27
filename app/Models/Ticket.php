<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\Commentions\Contracts\Commentable;
use Kirschbaum\Commentions\HasComments;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $code
 * @property int $owner_id
 * @property int|null $responsible_id
 * @property int $project_id
 * @property int $type_id
 * @property int $status_id
 * @property int $priority_id
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TicketLink> $allLinks
 * @property-read int|null $all_links_count
 * @property-read mixed $completude_percentage
 * @property-read mixed $estimation_for_humans
 * @property-read mixed $estimation_in_seconds
 * @property-read mixed $estimation_progress
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TicketLink> $inwardLinks
 * @property-read int|null $inward_links_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TicketLink> $outwardLinks
 * @property-read int|null $outward_links_count
 * @property-read \App\Models\User $owner
 * @property-read \App\Models\TicketPriority $priority
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\User|null $responsible
 * @property-read \App\Models\Sprint|null $sprint
 * @property-read \App\Models\Sprint|null $sprints
 * @property-read \App\Models\TicketStatus $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $subscribers
 * @property-read int|null $subscribers_count
 * @property-read mixed $total_logged_hours
 * @property-read mixed $total_logged_in_hours
 * @property-read mixed $total_logged_seconds
 * @property-read \App\Models\TicketType $type
 * @property-read mixed $watchers
 *
 * @method static \Database\Factories\TicketFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket wherePriorityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereResponsibleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Ticket extends Model implements Commentable, HasMedia
{
    use HasComments, HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'owner_id', 'responsible_id',
        'status_id', 'project_id', 'code', 'order', 'type_id',
        'priority_id', 'estimation', 'epic_id', 'sprint_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Ticket $item) {
            $project = Project::where('id', $item->project_id)->first();
            $count = Ticket::where('project_id', $project->id)->count();
            $order = $project->tickets?->last()?->order ?? -1;
            $item->code = $project->ticket_prefix.'-'.($count + 1);
            $item->order = $order + 1;
        });

        static::created(function (Ticket $item) {
            if ($item->sprint_id && $item->sprint->epic_id) {
                Ticket::where('id', $item->id)->update(['epic_id' => $item->sprint->epic_id]);
            }
        });
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_id', 'id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'status_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TicketType::class, 'type_id', 'id');
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id', 'id');
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ticket_subscribers', 'ticket_id', 'user_id');
    }

    public function sprint(): BelongsTo
    {
        return $this->belongsTo(Sprint::class, 'sprint_id', 'id');
    }

    public function sprints(): BelongsTo
    {
        return $this->belongsTo(Sprint::class, 'sprint_id', 'id');
    }

    // Outward links (this ticket is the source)
    public function outwardLinks(): HasMany
    {
        return $this->hasMany(TicketLink::class, 'source_ticket_id');
    }

    // Inward links (this ticket is the target)
    public function inwardLinks(): HasMany
    {
        return $this->hasMany(TicketLink::class, 'target_ticket_id');
    }

    // All links (both directions)
    public function allLinks(): HasMany
    {
        return $this->hasMany(TicketLink::class, 'source_ticket_id')
            ->union(
                $this->hasMany(TicketLink::class, 'target_ticket_id')
            );
    }

    public function watchers(): Attribute
    {
        return new Attribute(
            get: function () {
                $users = $this->project->users;
                $users->push($this->owner);
                if ($this->responsible) {
                    $users->push($this->responsible);
                }

                return $users->unique('id');
            }
        );
    }

    public function totalLoggedHours(): Attribute
    {
        return new Attribute(
            get: function () {
                $seconds = $this->hours->sum('value') * 3600;

                return CarbonInterval::seconds($seconds)->cascade()->forHumans();
            }
        );
    }

    public function totalLoggedSeconds(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->hours->sum('value') * 3600;
            }
        );
    }

    public function totalLoggedInHours(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->hours->sum('value');
            }
        );
    }

    public function estimationForHumans(): Attribute
    {
        return new Attribute(
            get: function () {
                return CarbonInterval::seconds($this->estimationInSeconds)->cascade()->forHumans();
            }
        );
    }

    public function estimationInSeconds(): Attribute
    {
        return new Attribute(
            get: function () {
                if (! $this->estimation) {
                    return null;
                }

                return $this->estimation * 3600;
            }
        );
    }

    public function estimationProgress(): Attribute
    {
        return new Attribute(
            get: function () {
                return (($this->totalLoggedSeconds ?? 0) / ($this->estimationInSeconds ?? 1)) * 100;
            }
        );
    }

    public function completudePercentage(): Attribute
    {
        return new Attribute(
            get: fn () => $this->estimationProgress
        );
    }
}
