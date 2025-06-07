<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('ထည့်သွင်းခြင်း အောင်မြင်ပါသည်')
            ->body('Your changes have been saved successfully!');
    }
}
