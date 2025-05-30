<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalOrderItem extends Model
{
    protected $fillable = [
        "medical_order_id","medical_id","quantity","price"
    ];
     public function total_price()
    {
        return $this->selectRaw('quantity * price as total')->value('total');
    }
    public function medical()
    {
        return $this->belongsTo(Medical::class);
    }
    public function medicals()
    {
        return $this->hasMany(Medical::class);
    }
}
