<x-filament-widgets::widget class="fi-filament-info-widget">
    <x-filament::section>
        <div class="fi-filament-info-widget-main">
            <h3 class="fi-account-widget-heading">
                {{ $title }}
            </h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $description }}
            </p>
        </div>
        <div class="fi-filament-info-widget-links">
            @if(!empty($link))
                <x-filament::button tag="a" href="{{ $link }}" :icon="$buttonIcon" target="{{ $newTab ? '_blank' : 'self' }}">
                    {{ $buttonText }}
                </x-filament::button>
            @else
                <x-filament::badge color="warning">No link provided</x-filament::badge>
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
