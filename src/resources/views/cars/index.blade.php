@extends('layouts.app')

@section('title', 'Коли')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0"><i class="bi bi-car-front-fill text-warning"></i> Коли</h2>
    <a href="{{ route('cars.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-lg"></i> Добави кола
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Марка / Модел</th>
                    <th>Година</th>
                    <th>Регистрация</th>
                    <th>VIN</th>
                    <th>Собственик</th>
                    <th>Ремонти</th>
                    <th colspan="3">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cars as $car)
                <tr>
                    <td class="text-muted">{{ $car->id }}</td>
                    <td><strong>{{ $car->make }} {{ $car->model }}</strong></td>
                    <td>{{ $car->year }}</td>
                    <td><span class="badge bg-secondary fs-6">{{ $car->plate }}</span></td>
                    <td><small class="text-muted">{{ $car->vin ?? '—' }}</small></td>
                    <td>{{ $car->user->name }}</td>
                    <td>
                        <span class="badge bg-primary">{{ $car->repairs->count() }}</span>
                    </td>
                    <td>
                        <a href="{{ route('cars.show', $car->id) }}" class="btn btn-sm btn-outline-info" title="Преглед">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-sm btn-outline-warning" title="Редактирай">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST"
                              onsubmit="return confirm('Сигурни ли сте? Ще се изтрият и всички ремонти!')">
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
                        <i class="bi bi-car-front fs-3 d-block mb-2"></i>
                        Няма добавени коли.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($cars->hasPages())
    <div class="card-footer">
        {{ $cars->links() }}
    </div>
    @endif
</div>

@endsection
