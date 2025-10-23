<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TicketPriority;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPriorityPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TicketPriority');
    }

    public function view(AuthUser $authUser, TicketPriority $ticketPriority): bool
    {
        return $authUser->can('View:TicketPriority');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TicketPriority');
    }

    public function update(AuthUser $authUser, TicketPriority $ticketPriority): bool
    {
        return $authUser->can('Update:TicketPriority');
    }

    public function delete(AuthUser $authUser, TicketPriority $ticketPriority): bool
    {
        return $authUser->can('Delete:TicketPriority');
    }

    public function restore(AuthUser $authUser, TicketPriority $ticketPriority): bool
    {
        return $authUser->can('Restore:TicketPriority');
    }

    public function forceDelete(AuthUser $authUser, TicketPriority $ticketPriority): bool
    {
        return $authUser->can('ForceDelete:TicketPriority');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TicketPriority');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TicketPriority');
    }

    public function replicate(AuthUser $authUser, TicketPriority $ticketPriority): bool
    {
        return $authUser->can('Replicate:TicketPriority');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TicketPriority');
    }

}