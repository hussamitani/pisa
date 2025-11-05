<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Teams\RelationManagers;

use App\Filament\Admin\Resources\Users\UserResource;
use Filament\Actions\AttachAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $relatedResource = UserResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                AttachAction::make(),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
