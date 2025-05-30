<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
class MedicineSaleDailyReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.medicine-sale-daily-report';
    protected static ?string $navigationLabel = 'Medicine sale report';
    protected static ?string $navigationGroup = 'Reports';

    // Optional logic
    public function getDailySales()
    {
        $sub = DB::table('medical_orders')
            ->selectRaw('id, DATE(date) as date, discount + foc as total_discount_foc')
            ->groupBy('id', DB::raw('DATE(date)'));
        return  DB::table('medical_order_items')
            ->joinSub($sub, 'orders', function ($join) {
                $join->on('medical_order_items.medical_order_id', '=', 'orders.id');
            })
            ->selectRaw('orders.date')
            ->selectRaw('SUM(medical_order_items.quantity) as total_quantity')
            ->selectRaw('SUM(medical_order_items.quantity * medical_order_items.price) as total_amount')
            ->selectRaw('SUM(DISTINCT orders.total_discount_foc) as total_discount_foc')
            ->groupBy('orders.date')
            ->orderByDesc('orders.date')
            ->paginate(20);
    }
}
