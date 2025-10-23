<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TicketType;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketTypePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TicketType');
    }

    public function view(AuthUser $authUser, TicketType $ticketType): bool
    {
        return $authUser->can('View:TicketType');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TicketType');
    }

    public function update(AuthUser $authUser, TicketType $ticketType): bool
    {
        return $authUser->can('Update:TicketType');
    }

    public function delete(AuthUser $authUser, TicketType $ticketType): bool
    {
        return $authUser->can('Delete:TicketType');
    }

    public function restore(AuthUser $authUser, TicketType $ticketType): bool
    {
        return $authUser->can('Restore:TicketType');
    }

    public function forceDelete(AuthUser $authUser, TicketType $ticketType): bool
    {
        return $authUser->can('ForceDelete:TicketType');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TicketType');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TicketType');
    }

    public function replicate(AuthUser $authUser, TicketType $ticketType): bool
    {
        return $authUser->can('Replicate:TicketType');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TicketType');
    }

}