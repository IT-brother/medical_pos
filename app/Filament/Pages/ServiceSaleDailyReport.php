<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
class ServiceSaleDailyReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.service-sale-daily-report';
    protected static ?string $navigationLabel = 'Service sale report';
    protected static ?string $navigationGroup = 'Reports';

    // Optional logic
    public function getDailySales()
    {
        $sub = DB::table('service_orders')
            ->selectRaw('id, DATE(date) as date, ANY_VALUE(discount + foc) as total_discount_foc')
            ->groupBy('id', DB::raw('DATE(date)'));
        return  DB::table('service_order_items')
            ->joinSub($sub, 'orders', function ($join) {
                $join->on('service_order_items.service_order_id', '=', 'orders.id');
            })
            ->selectRaw('orders.date')
            ->selectRaw('SUM(service_order_items.quantity) as total_quantity')
            ->selectRaw('SUM(service_order_items.quantity * service_order_items.price) as total_amount')
            ->selectRaw('SUM(DISTINCT orders.total_discount_foc) as total_discount_foc')
            ->groupBy('orders.date')
            ->orderByDesc('orders.date')
            ->paginate(20);
    }
}
