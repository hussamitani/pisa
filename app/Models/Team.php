<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    protected $fillable = ['name'];

    protected $withCount = ['users', 'projects'];

    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'team_projects',
        );
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'team_users'
        );
    }
}
