<?php

namespace App\Filament\Resources\KotaResource\Pages;

use App\Filament\Resources\KotaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKotas extends ManageRecords
{
    protected static string $resource = KotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
