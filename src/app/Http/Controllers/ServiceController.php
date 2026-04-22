<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(10);
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'price'            => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1|max:1440',
        ], [
            'name.required'             => 'Наименованието е задължително.',
            'price.required'            => 'Цената е задължителна.',
            'price.numeric'             => 'Цената трябва да е число.',
            'price.min'                 => 'Цената не може да е отрицателна.',
            'duration_minutes.required' => 'Продължителността е задължителна.',
            'duration_minutes.integer'  => 'Продължителността трябва да е цяло число (минути).',
            'duration_minutes.min'      => 'Минималната продължителност е 1 минута.',
        ]);

        Service::create($validatedData);

        return redirect()->route('services.index')
            ->with('success', 'Услугата е добавена успешно!');
    }

    public function show(Service $service)
    {
        $service->load('repairs');
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'price'            => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1|max:1440',
        ], [
            'name.required'             => 'Наименованието е задължително.',
            'price.required'            => 'Цената е задължителна.',
            'price.numeric'             => 'Цената трябва да е число.',
            'duration_minutes.required' => 'Продължителността е задължителна.',
        ]);

        $service->update($validatedData);

        return redirect()->route('services.index')
            ->with('success', 'Услугата е обновена успешно!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')
            ->with('success', 'Услугата е изтрита успешно!');
    }
}
