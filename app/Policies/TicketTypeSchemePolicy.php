<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TicketTypeScheme;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketTypeSchemePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TicketTypeScheme');
    }

    public function view(AuthUser $authUser, TicketTypeScheme $ticketTypeScheme): bool
    {
        return $authUser->can('View:TicketTypeScheme');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TicketTypeScheme');
    }

    public function update(AuthUser $authUser, TicketTypeScheme $ticketTypeScheme): bool
    {
        return $authUser->can('Update:TicketTypeScheme');
    }

    public function delete(AuthUser $authUser, TicketTypeScheme $ticketTypeScheme): bool
    {
        return $authUser->can('Delete:TicketTypeScheme');
    }

    public function restore(AuthUser $authUser, TicketTypeScheme $ticketTypeScheme): bool
    {
        return $authUser->can('Restore:TicketTypeScheme');
    }

    public function forceDelete(AuthUser $authUser, TicketTypeScheme $ticketTypeScheme): bool
    {
        return $authUser->can('ForceDelete:TicketTypeScheme');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TicketTypeScheme');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TicketTypeScheme');
    }

    public function replicate(AuthUser $authUser, TicketTypeScheme $ticketTypeScheme): bool
    {
        return $authUser->can('Replicate:TicketTypeScheme');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TicketTypeScheme');
    }

}