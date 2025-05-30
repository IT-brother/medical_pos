<?php

namespace App\Filament\Resources\ServiceOrderResource\Pages;

use App\Filament\Resources\ServiceOrderResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListServiceOrders extends ListRecords
{
    protected static string $resource = ServiceOrderResource::class;

    protected function getHeaderActions(): array
    {
         return [
            Action::make('create')
                ->label('Create Service Order') // Change button label
                ->url(fn () => route('service.invoice.create')) // Custom route
                ->icon('heroicon-o-plus') // Optional: icon
                ->color('success'),
        ];
        
    }
}
