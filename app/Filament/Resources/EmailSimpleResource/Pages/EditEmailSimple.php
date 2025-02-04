<?php

namespace App\Filament\Resources\EmailSimpleResource\Pages;

use App\Filament\Resources\EmailSimpleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmailSimple extends EditRecord
{
    protected static string $resource = EmailSimpleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
