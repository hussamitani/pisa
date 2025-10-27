<?php

declare(strict_types=1);

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum TicketStatusCategory: string implements HasLabel
{
    case TODO = 'to_do';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';

    public function getColor(): string
    {
        return match ($this) {
            self::TODO => 'gray',
            self::IN_PROGRESS => 'primary',
            self::DONE => 'success',
        };
    }

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::TODO => __('To Do'),
            self::IN_PROGRESS => __('In Progress'),
            self::DONE => __('Done'),
        };
    }
}
