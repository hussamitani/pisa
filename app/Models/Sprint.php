<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $project_id
 * @property \Illuminate\Support\Carbon $begins_at
 * @property \Illuminate\Support\Carbon $ends_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @property-read mixed $remaining
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket> $tickets
 * @property-read int|null $tickets_count
 *
 * @method static \Database\Factories\SprintFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereBeginsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Sprint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'begins_at', 'ends_at', 'description', 'project_id',
    ];

    protected $casts = [
        'begins_at' => 'date',
        'ends_at' => 'date',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'sprint_id', 'id')->orderBy('sprint_position');
    }

    public function remaining(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->starts_at && $this->ends_at && $this->started_at && ! $this->ended_at) {
                    return $this->ends_at->diffInDays(now()) + 1;
                }

                return null;
            }
        );
    }
}
