<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrderItem extends Model
{
    protected $fillable = [
        "service_order_id","service_id","quantity","price"
    ];
     public function total_price()
    {
        return $this->selectRaw('quantity * price as total')->value('total');
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
