<?php

namespace App\Filament\Resources\MedicalResource\Pages;

use App\Filament\Resources\MedicalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
class CreateMedical extends CreateRecord
{
    protected static string $resource = MedicalResource::class;
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('ထည့်သွင်းခြင်း အောင်မြင်ပါသည်')
            ->body('Your changes have been saved successfully!');
    }
}
