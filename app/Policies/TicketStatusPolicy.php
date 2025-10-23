<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\TicketStatus;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class TicketStatusPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TicketStatus');
    }

    public function view(AuthUser $authUser, TicketStatus $ticketStatus): bool
    {
        return $authUser->can('View:TicketStatus');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TicketStatus');
    }

    public function update(AuthUser $authUser, TicketStatus $ticketStatus): bool
    {
        return $authUser->can('Update:TicketStatus');
    }

    public function delete(AuthUser $authUser, TicketStatus $ticketStatus): bool
    {
        return $authUser->can('Delete:TicketStatus');
    }

    public function restore(AuthUser $authUser, TicketStatus $ticketStatus): bool
    {
        return $authUser->can('Restore:TicketStatus');
    }

    public function forceDelete(AuthUser $authUser, TicketStatus $ticketStatus): bool
    {
        return $authUser->can('ForceDelete:TicketStatus');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TicketStatus');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TicketStatus');
    }

    public function replicate(AuthUser $authUser, TicketStatus $ticketStatus): bool
    {
        return $authUser->can('Replicate:TicketStatus');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TicketStatus');
    }
}
