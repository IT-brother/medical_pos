<?php

namespace App\Filament\Resources\MedicalTypeResource\Pages;

use App\Filament\Resources\MedicalTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
class CreateMedicalType extends CreateRecord
{
    protected static string $resource = MedicalTypeResource::class;
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('ထည့်သွင်းခြင်း အောင်မြင်ပါသည်')
            ->body('Your changes have been saved successfully!');
    }
}
