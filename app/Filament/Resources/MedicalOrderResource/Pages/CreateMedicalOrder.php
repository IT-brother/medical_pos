<?php

namespace App\Filament\Resources\MedicalOrderResource\Pages;

use App\Filament\Resources\MedicalOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMedicalOrder extends CreateRecord
{
    protected static string $resource = MedicalOrderResource::class;
}
