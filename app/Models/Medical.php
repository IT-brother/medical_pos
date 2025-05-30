<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    protected $fillable = [
        "name","medical_type_id"
    ];
    public function medical_type()
    {
        return $this->belongsTo(MedicalType::class);
    }
}
