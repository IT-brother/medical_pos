<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
     protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('အကောင့်စာရင်းသွင်းခြင်း အောင်မြင်ပါသည်')
            ->body('Your changes have been saved successfully!');
    }
}
