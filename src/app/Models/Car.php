<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['user_id', 'make', 'model', 'year', 'plate', 'vin'];

    // Връзка: кола принадлежи на потребител
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Връзка: кола има много ремонти
    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
