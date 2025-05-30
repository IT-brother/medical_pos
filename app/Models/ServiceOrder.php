<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    protected $fillable = [
        "voucher_no","payment","discount","foc","date","patient","address","user_id"
    ];
    public function serviceitems()
    {
        return $this->hasMany(ServiceOrderItem::class);
    }
    public function totalPrice()
    {
        return $this->serviceitems()->selectRaw('SUM(quantity * price) as total')->value('total');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
