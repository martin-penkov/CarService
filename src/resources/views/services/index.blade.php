@extends('layouts.app')

@section('title', 'Услуги')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0"><i class="bi bi-list-check text-warning"></i> Услуги</h2>
    <a href="{{ route('services.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-lg"></i> Добави услуга
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Наименование</th>
                    <th>Описание</th>
                    <th>Цена</th>
                    <th>Продължителност</th>
                    <th colspan="3">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td class="text-muted">{{ $service->id }}</td>
                    <td><strong>{{ $service->name }}</strong></td>
                    <td><small class="text-muted">{{ Str::limit($service->description, 60) ?? '—' }}</small></td>
                    <td><span class="fw-semibold text-success">{{ number_format($service->price, 2) }} лв.</span></td>
                    <td>{{ $service->duration_minutes }} мин.</td>
                    <td>
                        <a href="{{ route('services.show', $service->id) }}" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                              onsubmit="return confirm('Изтриване на услугата?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="bi bi-list-check fs-3 d-block mb-2"></i>
                        Няма добавени услуги.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($services->hasPages())
    <div class="card-footer">
        {{ $services->links() }}
    </div>
    @endif
</div>

@endsection
