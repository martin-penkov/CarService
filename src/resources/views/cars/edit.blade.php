@extends('layouts.app')

@section('title', 'Редактирай кола')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="fw-bold mb-0"><i class="bi bi-pencil-square text-warning"></i> Редактиране на кола</h2>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-body">
        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Марка <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('make') is-invalid @enderror"
                       name="make" value="{{ old('make', $car->make) }}">
                @error('make')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Модел <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('model') is-invalid @enderror"
                       name="model" value="{{ old('model', $car->model) }}">
                @error('model')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Година <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('year') is-invalid @enderror"
                       name="year" value="{{ old('year', $car->year) }}"
                       min="1900" max="{{ date('Y') + 1 }}">
                @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Регистрационен номер <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('plate') is-invalid @enderror"
                       name="plate" value="{{ old('plate', $car->plate) }}">
                @error('plate')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">VIN номер <small class="text-muted">(незадължително)</small></label>
                <input type="text" class="form-control @error('vin') is-invalid @enderror"
                       name="vin" value="{{ old('vin', $car->vin) }}" maxlength="17">
                @error('vin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-floppy"></i> Обнови
                </button>
                <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary">Отказ</a>
            </div>
        </form>
    </div>
</div>

@endsection
