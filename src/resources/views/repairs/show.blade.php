@extends('layouts.app')

@section('title', 'Детайли за ремонт')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('repairs.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="fw-bold mb-0"><i class="bi bi-tools text-warning"></i> Детайли за ремонт #{{ $repair->id }}</h2>
</div>

<div class="row g-4" style="max-width: 800px;">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <strong>Информация за ремонта</strong>
                <span class="badge bg-{{ $repair->statusClass() }} fs-6">{{ $repair->statusLabel() }}</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <th class="text-muted">Кола</th>
                                <td>
                                    <a href="{{ route('cars.show', $repair->car->id) }}">
                                        {{ $repair->car->make }} {{ $repair->car->model }}
                                    </a>
                                    <br><small class="text-muted">{{ $repair->car->plate }}</small>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">Собственик</th>
                                <td>{{ $repair->car->user->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Услуга</th>
                                <td>{{ $repair->service->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Дата</th>
                                <td>{{ $repair->repair_date }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <th class="text-muted">Цена на услугата</th>
                                <td>{{ $repair->service->price }} лв.</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Крайна цена</th>
                                <td class="fw-bold fs-5 text-success">{{ number_format($repair->total_price, 2) }} лв.</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Километраж</th>
                                <td>{{ $repair->mileage ? number_format($repair->mileage) . ' км' : '—' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Продължителност</th>
                                <td>{{ $repair->service->duration_minutes }} мин.</td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($repair->notes)
                <hr>
                <h6 class="text-muted">Бележки на механика:</h6>
                <p class="mb-0">{{ $repair->notes }}</p>
                @endif
            </div>
            <div class="card-footer d-flex gap-2">
                <a href="{{ route('repairs.edit', $repair->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Редактирай
                </a>
                <form action="{{ route('repairs.destroy', $repair->id) }}" method="POST"
                      onsubmit="return confirm('Изтриване на ремонта?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Изтрий
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
