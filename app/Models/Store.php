<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
    protected $fillable = [
        'outlet_sap_id',
        'name',
        'department_id',
        'store_type',
        'operational_date',
        'address',
        'latitude',
        'longitude',
        'phone',
    ];

    public function department(): belongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
