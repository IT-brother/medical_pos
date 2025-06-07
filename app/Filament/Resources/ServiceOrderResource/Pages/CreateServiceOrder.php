<?php

namespace App\Filament\Resources\ServiceOrderResource\Pages;

use App\Filament\Resources\ServiceOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
class CreateServiceOrder extends CreateRecord
{
    protected static string $resource = ServiceOrderResource::class;
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('ထည့်သွင်းခြင်း အောင်မြင်ပါသည်')
            ->body('Your changes have been saved successfully!');
    }
}
