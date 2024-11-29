<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['id', 'name'];

    public function users(): hasMany
    {
        return $this->hasMany(User::class);
    }

    public function stores(): HasMany
    {
        return $this->hasmany(Store::class);
    }
}
