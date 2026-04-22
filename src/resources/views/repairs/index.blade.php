@extends('layouts.app')

@section('title', 'Ремонти')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0"><i class="bi bi-tools text-warning"></i> Ремонти</h2>
    <a href="{{ route('repairs.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-lg"></i> Нов ремонт
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Кола</th>
                    <th>Услуга</th>
                    <th>Дата</th>
                    <th>Цена</th>
                    <th>Километраж</th>
                    <th>Статус</th>
                    <th colspan="3">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($repairs as $repair)
                <tr>
                    <td class="text-muted">{{ $repair->id }}</td>
                    <td>
                        <strong>{{ $repair->car->make }} {{ $repair->car->model }}</strong>
                        <br><small class="text-muted">{{ $repair->car->plate }}</small>
                    </td>
                    <td>{{ $repair->service->name }}</td>
                    <td>{{ $repair->repair_date }}</td>
                    <td>{{ number_format($repair->total_price, 2) }} лв.</td>
                    <td>{{ $repair->mileage ? number_format($repair->mileage) . ' км' : '—' }}</td>
                    <td>
                        <span class="badge bg-{{ $repair->statusClass() }}">
                            {{ $repair->statusLabel() }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('repairs.show', $repair->id) }}" class="btn btn-sm btn-outline-info" title="Преглед">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('repairs.edit', $repair->id) }}" class="btn btn-sm btn-outline-warning" title="Редактирай">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('repairs.destroy', $repair->id) }}" method="POST"
                              onsubmit="return confirm('Изтриване на ремонта?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Изтрий">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted py-4">
                        <i class="bi bi-tools fs-3 d-block mb-2"></i>
                        Няма добавени ремонти.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($repairs->hasPages())
    <div class="card-footer">
        {{ $repairs->links() }}
    </div>
    @endif
</div>

@endsection
