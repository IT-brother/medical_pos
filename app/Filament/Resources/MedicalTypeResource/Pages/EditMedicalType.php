<?php

namespace App\Filament\Resources\MedicalTypeResource\Pages;

use App\Filament\Resources\MedicalTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
class EditMedicalType extends EditRecord
{
    protected static string $resource = MedicalTypeResource::class;
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('ပြင်ဆင်ခြင်း အောင်မြင်ပါသည်')
            ->body('Your changes have been saved successfully!');
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
