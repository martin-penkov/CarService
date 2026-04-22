@extends('layouts.app')

@section('title', $car->make . ' ' . $car->model)

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="fw-bold mb-0">
        <i class="bi bi-car-front-fill text-warning"></i>
        {{ $car->make }} {{ $car->model }} ({{ $car->year }})
    </h2>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-dark text-white fw-semibold">
                <i class="bi bi-info-circle"></i> Данни за колата
            </div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <tr>
                        <th class="text-muted">Марка</th>
                        <td>{{ $car->make }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Модел</th>
                        <td>{{ $car->model }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Година</th>
                        <td>{{ $car->year }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Регистрация</th>
                        <td><span class="badge bg-secondary fs-6">{{ $car->plate }}</span></td>
                    </tr>
                    <tr>
                        <th class="text-muted">VIN</th>
                        <td><small>{{ $car->vin ?? '—' }}</small></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Собственик</th>
                        <td>{{ $car->user->name }}</td>
                    </tr>
                </table>
            </div>
            <div class="card-footer d-flex gap-2">
                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> Редактирай
                </a>
                <a href="{{ route('repairs.create') }}" class="btn btn-dark btn-sm">
                    <i class="bi bi-plus"></i> Нов ремонт
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark text-white fw-semibold">
                <i class="bi bi-tools"></i> История на ремонтите
                <span class="badge bg-warning text-dark ms-2">{{ $car->repairs->count() }}</span>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Услуга</th>
                            <th>Дата</th>
                            <th>Цена</th>
                            <th>Км</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($car->repairs as $repair)
                        <tr>
                            <td>{{ $repair->service->name }}</td>
                            <td>{{ $repair->repair_date }}</td>
                            <td>{{ number_format($repair->total_price, 2) }} лв.</td>
                            <td>{{ $repair->mileage ? number_format($repair->mileage) : '—' }}</td>
                            <td>
                                <span class="badge bg-{{ $repair->statusClass() }}">
                                    {{ $repair->statusLabel() }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('repairs.show', $repair->id) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Няма ремонти за тази кола.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
