<?php

namespace App\Filament\Resources\MedicalOrderResource\Pages;

use App\Filament\Resources\MedicalOrderResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListMedicalOrders extends ListRecords
{
    protected static string $resource = MedicalOrderResource::class;

    protected function getHeaderActions(): array
    {
         return [
            Action::make('create')
                ->label('Create Medicine Order') // Change button label
                ->url(fn () => route('medical.invoice.create')) // Custom route
                ->icon('heroicon-o-plus') // Optional: icon
                ->color('success'),
        ];
    }
}
