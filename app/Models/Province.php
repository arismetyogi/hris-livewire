<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    protected $fillable = ['name', 'name_en', 'code'];

    public function zips(): HasMany
    {
        return $this->hasMany(Zip::class, 'code', 'province_code');
    }
}
