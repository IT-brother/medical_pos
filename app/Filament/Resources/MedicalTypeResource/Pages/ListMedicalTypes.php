<?php

namespace App\Filament\Resources\MedicalTypeResource\Pages;

use App\Filament\Resources\MedicalTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicalTypes extends ListRecords
{
    protected static string $resource = MedicalTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
