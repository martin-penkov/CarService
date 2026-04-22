<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'price', 'duration_minutes'];

    // Връзка: услугата е използвана в много ремонти
    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
