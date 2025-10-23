<?php

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

    public string|Heroicon $buttonIcon = 'heroicon-o-arrow-top-right-on-square';

    public bool $newTab = true;

    protected string $view = 'livewire.link-widget';

    public static function to(
        string $link,
        string $title,
        string $description,
        string $buttonText,
        string|Heroicon $buttonIcon = null,
        ?bool $newTab = false,
    ): WidgetConfiguration
    {
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
