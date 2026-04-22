<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    // Списък с всички коли
    public function index()
    {
        $cars = Car::with('user')->paginate(10);
        return view('cars.index', compact('cars'));
    }

    // Форма за добавяне
    public function create()
    {
        return view('cars.create');
    }

    // Запазване на нова кола
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'make'  => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year'  => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'plate' => 'required|string|max:20|unique:cars,plate',
            'vin'   => 'nullable|string|max:17',
        ], [
            'make.required'  => 'Марката е задължителна.',
            'model.required' => 'Моделът е задължителен.',
            'year.required'  => 'Годината е задължителна.',
            'year.min'       => 'Годината не може да е преди 1900.',
            'plate.required' => 'Регистрационният номер е задължителен.',
            'plate.unique'   => 'Тази регистрация вече съществува в системата.',
            'vin.max'        => 'VIN номерът е максимум 17 символа.',
        ]);

        $validatedData['user_id'] = Auth::id();

        Car::create($validatedData);

        return redirect()->route('cars.index')
            ->with('success', 'Колата е добавена успешно!');
    }

    // Преглед на кола
    public function show(Car $car)
    {
        $car->load(['repairs.service']);
        return view('cars.show', compact('car'));
    }

    // Форма за редактиране
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    // Обновяване на кола
    public function update(Request $request, Car $car)
    {
        $validatedData = $request->validate([
            'make'  => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year'  => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'plate' => 'required|string|max:20|unique:cars,plate,' . $car->id,
            'vin'   => 'nullable|string|max:17',
        ], [
            'make.required'  => 'Марката е задължителна.',
            'model.required' => 'Моделът е задължителен.',
            'year.required'  => 'Годината е задължителна.',
            'plate.required' => 'Регистрационният номер е задължителен.',
            'plate.unique'   => 'Тази регистрация вече съществува в системата.',
        ]);

        $car->update($validatedData);

        return redirect()->route('cars.index')
            ->with('success', 'Данните за колата са обновени успешно!');
    }

    // Изтриване на кола
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')
            ->with('success', 'Колата е изтрита успешно!');
    }
}
