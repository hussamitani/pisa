<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\TicketLinkType;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class TicketLinkTypePolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TicketLinkType');
    }

    public function view(AuthUser $authUser, TicketLinkType $ticketLinkType): bool
    {
        return $authUser->can('View:TicketLinkType');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TicketLinkType');
    }

    public function update(AuthUser $authUser, TicketLinkType $ticketLinkType): bool
    {
        return $authUser->can('Update:TicketLinkType');
    }

    public function delete(AuthUser $authUser, TicketLinkType $ticketLinkType): bool
    {
        return $authUser->can('Delete:TicketLinkType');
    }

    public function restore(AuthUser $authUser, TicketLinkType $ticketLinkType): bool
    {
        return $authUser->can('Restore:TicketLinkType');
    }

    public function forceDelete(AuthUser $authUser, TicketLinkType $ticketLinkType): bool
    {
        return $authUser->can('ForceDelete:TicketLinkType');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TicketLinkType');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TicketLinkType');
    }

    public function replicate(AuthUser $authUser, TicketLinkType $ticketLinkType): bool
    {
        return $authUser->can('Replicate:TicketLinkType');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TicketLinkType');
    }
}
