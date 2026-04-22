<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $fillable = ['car_id', 'service_id', 'repair_date', 'notes', 'total_price', 'status', 'mileage'];

    // Връзка: ремонтът е за определена кола
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // Връзка: ремонтът използва определена услуга
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Помощен метод за статус на български
    public function statusLabel()
    {
        return match($this->status) {
            'pending'     => 'Изчакване',
            'in_progress' => 'В процес',
            'completed'   => 'Завършен',
            'cancelled'   => 'Отказан',
            default       => $this->status,
        };
    }

    // CSS клас за статус бейдж
    public function statusClass()
    {
        return match($this->status) {
            'pending'     => 'warning',
            'in_progress' => 'info',
            'completed'   => 'success',
            'cancelled'   => 'danger',
            default       => 'secondary',
        };
    }
}
