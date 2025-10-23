<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\TicketPriorityScheme;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class TicketPrioritySchemePolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TicketPriorityScheme');
    }

    public function view(AuthUser $authUser, TicketPriorityScheme $ticketPriorityScheme): bool
    {
        return $authUser->can('View:TicketPriorityScheme');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TicketPriorityScheme');
    }

    public function update(AuthUser $authUser, TicketPriorityScheme $ticketPriorityScheme): bool
    {
        return $authUser->can('Update:TicketPriorityScheme');
    }

    public function delete(AuthUser $authUser, TicketPriorityScheme $ticketPriorityScheme): bool
    {
        return $authUser->can('Delete:TicketPriorityScheme');
    }

    public function restore(AuthUser $authUser, TicketPriorityScheme $ticketPriorityScheme): bool
    {
        return $authUser->can('Restore:TicketPriorityScheme');
    }

    public function forceDelete(AuthUser $authUser, TicketPriorityScheme $ticketPriorityScheme): bool
    {
        return $authUser->can('ForceDelete:TicketPriorityScheme');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TicketPriorityScheme');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TicketPriorityScheme');
    }

    public function replicate(AuthUser $authUser, TicketPriorityScheme $ticketPriorityScheme): bool
    {
        return $authUser->can('Replicate:TicketPriorityScheme');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TicketPriorityScheme');
    }
}
