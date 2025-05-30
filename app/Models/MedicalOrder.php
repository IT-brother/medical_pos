<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalOrder extends Model
{
    protected $fillable = [
        "voucher_no","payment","discount","foc","date","patient","address","user_id"
    ];
     public function medicalitems()
    {
        return $this->hasMany(MedicalOrderItem::class);
    }
    public function totalPrice()
    {
        return $this->medicalitems()->selectRaw('SUM(quantity * price) as total')->value('total');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
