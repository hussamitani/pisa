<?php

declare(strict_types=1);

namespace App\Providers;

use Filament\Forms\Components\RichEditor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RichEditor::configureUsing(function (RichEditor $richEditor) {
            $richEditor->toolbarButtons([
                'h1',
                'h2',
                'h3',
                'bold',
                'italic',
                'underline',
                'strike',
                'bulletList',
                'orderedList',
                'undo',
                'redo',
            ]);
        });
    }
}
