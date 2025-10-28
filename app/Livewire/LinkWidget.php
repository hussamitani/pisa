<?php

declare(strict_types=1);

namespace App\Livewire;

use Filament\Support\Icons\Heroicon;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;

class LinkWidget extends Widget
{
    public ?string $link = null;

    public ?string $title = 'Quick Access';

    public ?string $description = 'Open the linked panel.';

    public ?string $buttonText = 'Open';

    public string|Heroicon $buttonIcon = Heroicon::ArrowTopRightOnSquare;

    public bool $newTab = true;

    protected string $view = 'livewire.link-widget';

    public static function to(
        string $link,
        string $title,
        string $description,
        string $buttonText,
        string|Heroicon $buttonIcon = Heroicon::ArrowTopRightOnSquare,
        ?bool $newTab = false,
    ): WidgetConfiguration {
        return LinkWidget::make([
            'link' => $link,
            'title' => $title,
            'description' => $description,
            'buttonText' => $buttonText,
            'buttonIcon' => $buttonIcon,
            'newTab' => $newTab,
        ]);
    }
}
