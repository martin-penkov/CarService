@extends('layouts.app')

@section('title', $service->name)

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('services.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="fw-bold mb-0"><i class="bi bi-list-check text-warning"></i> {{ $service->name }}</h2>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header bg-dark text-white fw-semibold">Детайли за услугата</div>
    <div class="card-body">
        <table class="table table-sm">
            <tr>
                <th class="text-muted" style="width:160px">Наименование</th>
                <td>{{ $service->name }}</td>
            </tr>
            <tr>
                <th class="text-muted">Описание</th>
                <td>{{ $service->description ?? '—' }}</td>
            </tr>
            <tr>
                <th class="text-muted">Цена</th>
                <td class="fw-bold text-success fs-5">{{ number_format($service->price, 2) }} лв.</td>
            </tr>
            <tr>
                <th class="text-muted">Продължителност</th>
                <td>{{ $service->duration_minutes }} мин.</td>
            </tr>
            <tr>
                <th class="text-muted">Брой ремонти</th>
                <td><span class="badge bg-primary">{{ $service->repairs->count() }}</span></td>
            </tr>
        </table>
    </div>
    <div class="card-footer d-flex gap-2">
        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Редактирай
        </a>
        <form action="{{ route('services.destroy', $service->id) }}" method="POST"
              onsubmit="return confirm('Изтриване на услугата?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger">
                <i class="bi bi-trash"></i> Изтрий
            </button>
        </form>
    </div>
</div>

@endsection
