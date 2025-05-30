<?php

namespace App\Filament\Resources\MedicalOrderResource\Pages;

use App\Filament\Resources\MedicalOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicalOrder extends EditRecord
{
    protected static string $resource = MedicalOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
