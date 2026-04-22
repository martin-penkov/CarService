@extends('layouts.app')

@section('title', 'Табло')

@section('content')

<h2 class="mb-4 fw-bold"><i class="bi bi-speedometer2 text-warning"></i> Табло</h2>

{{-- Статистически карти --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card primary p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small">Общо коли</div>
                    <div class="fs-2 fw-bold">{{ $totalCars }}</div>
                </div>
                <i class="bi bi-car-front-fill text-primary fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card warning p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small">Изчакващи</div>
                    <div class="fs-2 fw-bold">{{ $pendingRepairs }}</div>
                </div>
                <i class="bi bi-hourglass-split text-warning fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card info p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small">В процес</div>
                    <div class="fs-2 fw-bold">{{ $inProgressRepairs }}</div>
                </div>
                <i class="bi bi-tools text-info fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card success p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small">Приход (завършени)</div>
                    <div class="fs-2 fw-bold">{{ number_format($totalRevenue, 2) }} лв.</div>
                </div>
                <i class="bi bi-cash-stack text-success fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

{{-- Последни ремонти --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong><i class="bi bi-clock-history"></i> Последни ремонти</strong>
        <a href="{{ route('repairs.create') }}" class="btn btn-sm btn-dark">
            <i class="bi bi-plus"></i> Нов ремонт
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Кола</th>
                    <th>Услуга</th>
                    <th>Дата</th>
                    <th>Цена</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentRepairs as $repair)
                <tr>
                    <td class="text-muted">{{ $repair->id }}</td>
                    <td>
                        <strong>{{ $repair->car->make }} {{ $repair->car->model }}</strong>
                        <br><small class="text-muted">{{ $repair->car->plate }}</small>
                    </td>
                    <td>{{ $repair->service->name }}</td>
                    <td>{{ $repair->repair_date }}</td>
                    <td>{{ number_format($repair->total_price, 2) }} лв.</td>
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
                <tr><td colspan="7" class="text-center text-muted py-3">Няма записи.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
