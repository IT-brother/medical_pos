<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;
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
