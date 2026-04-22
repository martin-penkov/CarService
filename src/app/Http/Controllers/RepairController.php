<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\Car;
use App\Models\Service;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function index()
    {
        $repairs = Repair::with(['car', 'service'])->paginate(10);
        return view('repairs.index', compact('repairs'));
    }

    public function create()
    {
        $cars     = Car::all();
        $services = Service::all();
        return view('repairs.create', compact('cars', 'services'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'car_id'      => 'required|exists:cars,id',
            'service_id'  => 'required|exists:services,id',
            'repair_date' => 'required|date',
            'notes'       => 'nullable|string',
            'total_price' => 'required|numeric|min:0',
            'status'      => 'required|in:pending,in_progress,completed,cancelled',
            'mileage'     => 'nullable|integer|min:0',
        ], [
            'car_id.required'      => 'Изберете кола.',
            'car_id.exists'        => 'Избраната кола не съществува.',
            'service_id.required'  => 'Изберете услуга.',
            'service_id.exists'    => 'Избраната услуга не съществува.',
            'repair_date.required' => 'Датата е задължителна.',
            'repair_date.date'     => 'Въведете валидна дата.',
            'total_price.required' => 'Крайната цена е задължителна.',
            'total_price.numeric'  => 'Цената трябва да е число.',
            'total_price.min'      => 'Цената не може да е отрицателна.',
            'status.required'      => 'Статусът е задължителен.',
            'status.in'            => 'Невалиден статус.',
            'mileage.integer'      => 'Километражът трябва да е цяло число.',
            'mileage.min'          => 'Километражът не може да е отрицателен.',
        ]);

        Repair::create($validatedData);

        return redirect()->route('repairs.index')
            ->with('success', 'Ремонтът е добавен успешно!');
    }

    public function show(Repair $repair)
    {
        $repair->load(['car.user', 'service']);
        return view('repairs.show', compact('repair'));
    }

    public function edit(Repair $repair)
    {
        $cars     = Car::all();
        $services = Service::all();
        return view('repairs.edit', compact('repair', 'cars', 'services'));
    }

    public function update(Request $request, Repair $repair)
    {
        $validatedData = $request->validate([
            'car_id'      => 'required|exists:cars,id',
            'service_id'  => 'required|exists:services,id',
            'repair_date' => 'required|date',
            'notes'       => 'nullable|string',
            'total_price' => 'required|numeric|min:0',
            'status'      => 'required|in:pending,in_progress,completed,cancelled',
            'mileage'     => 'nullable|integer|min:0',
        ], [
            'car_id.required'      => 'Изберете кола.',
            'service_id.required'  => 'Изберете услуга.',
            'repair_date.required' => 'Датата е задължителна.',
            'total_price.required' => 'Крайната цена е задължителна.',
            'status.required'      => 'Статусът е задължителен.',
        ]);

        $repair->update($validatedData);

        return redirect()->route('repairs.index')
            ->with('success', 'Ремонтът е обновен успешно!');
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();
        return redirect()->route('repairs.index')
            ->with('success', 'Записът е изтрит успешно!');
    }
}
