<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Colegio extends Model
{
    use HasFactory;

    public function montos(): HasMany
    {
        return $this->hasMany(Monto::class);
    }
}
