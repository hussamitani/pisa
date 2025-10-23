<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\TicketStatusScheme;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class TicketStatusSchemePolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TicketStatusScheme');
    }

    public function view(AuthUser $authUser, TicketStatusScheme $ticketStatusScheme): bool
    {
        return $authUser->can('View:TicketStatusScheme');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TicketStatusScheme');
    }

    public function update(AuthUser $authUser, TicketStatusScheme $ticketStatusScheme): bool
    {
        return $authUser->can('Update:TicketStatusScheme');
    }

    public function delete(AuthUser $authUser, TicketStatusScheme $ticketStatusScheme): bool
    {
        return $authUser->can('Delete:TicketStatusScheme');
    }

    public function restore(AuthUser $authUser, TicketStatusScheme $ticketStatusScheme): bool
    {
        return $authUser->can('Restore:TicketStatusScheme');
    }

    public function forceDelete(AuthUser $authUser, TicketStatusScheme $ticketStatusScheme): bool
    {
        return $authUser->can('ForceDelete:TicketStatusScheme');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TicketStatusScheme');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TicketStatusScheme');
    }

    public function replicate(AuthUser $authUser, TicketStatusScheme $ticketStatusScheme): bool
    {
        return $authUser->can('Replicate:TicketStatusScheme');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TicketStatusScheme');
    }
}
