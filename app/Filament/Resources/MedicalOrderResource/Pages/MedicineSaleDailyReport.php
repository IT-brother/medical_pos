<?php

namespace App\Filament\Resources\MedicalOrderResource\Pages;

use App\Filament\Resources\MedicalOrderResource;
use Illuminate\Support\Collection;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;
class MedicineSaleDailyReport extends Page
{
    protected static string $view = 'filament.resources.medical-order-resource.pages.medicine-sale-daily-report';
    protected static string $resource = MedicalOrderResource::class;
    protected static ?string $navigationLabel = 'Daily Sales Report';
    public function getDailyReport()
    {
        return      DB::table('medical_order_items')
                    ->join('medical_orders', 'medical_order_items.medical_order_id', '=', 'medical_orders.id')
                    ->selectRaw('DATE(medical_orders.date) as date')
                    ->selectRaw('SUM(medical_order_items.quantity) as total_quantity')
                    ->selectRaw('SUM(medical_order_items.quantity * medical_order_items.price) as total_amount')
                    ->groupBy(DB::raw('DATE(medical_orders.created_at)'))
                    ->orderByDesc('date')
                    ->get();
    }
}
