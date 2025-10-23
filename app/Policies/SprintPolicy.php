<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Sprint;
use Illuminate\Auth\Access\HandlesAuthorization;

class SprintPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Sprint');
    }

    public function view(AuthUser $authUser, Sprint $sprint): bool
    {
        return $authUser->can('View:Sprint');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Sprint');
    }

    public function update(AuthUser $authUser, Sprint $sprint): bool
    {
        return $authUser->can('Update:Sprint');
    }

    public function delete(AuthUser $authUser, Sprint $sprint): bool
    {
        return $authUser->can('Delete:Sprint');
    }

    public function restore(AuthUser $authUser, Sprint $sprint): bool
    {
        return $authUser->can('Restore:Sprint');
    }

    public function forceDelete(AuthUser $authUser, Sprint $sprint): bool
    {
        return $authUser->can('ForceDelete:Sprint');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Sprint');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Sprint');
    }

    public function replicate(AuthUser $authUser, Sprint $sprint): bool
    {
        return $authUser->can('Replicate:Sprint');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Sprint');
    }

}