<?php

namespace App\Filament\Resources\MedicalTypeResource\Pages;

use App\Filament\Resources\MedicalTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicalType extends EditRecord
{
    protected static string $resource = MedicalTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
