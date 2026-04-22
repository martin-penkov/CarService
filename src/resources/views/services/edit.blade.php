@extends('layouts.app')

@section('title', 'Редактирай услуга')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('services.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="fw-bold mb-0"><i class="bi bi-pencil-square text-warning"></i> Редактиране на услуга</h2>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-body">
        <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Наименование <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name', $service->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Описание</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                          name="description" rows="3">{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Цена (лв.) <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('price') is-invalid @enderror"
                       name="price" value="{{ old('price', $service->price) }}"
                       min="0" step="0.01">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Продължителност (минути) <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror"
                       name="duration_minutes"
                       value="{{ old('duration_minutes', $service->duration_minutes) }}"
                       min="1" max="1440">
                @error('duration_minutes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-floppy"></i> Обнови
                </button>
                <a href="{{ route('services.index') }}" class="btn btn-outline-secondary">Отказ</a>
            </div>
        </form>
    </div>
</div>

@endsection
