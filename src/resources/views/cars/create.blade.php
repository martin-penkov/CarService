@extends('layouts.app')

@section('title', 'Добави кола')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="fw-bold mb-0"><i class="bi bi-plus-circle text-warning"></i> Добавяне на кола</h2>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-body">
        <form action="{{ route('cars.store') }}" method="POST">
            @csrf

            {{-- Марка --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Марка <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('make') is-invalid @enderror"
                       name="make" value="{{ old('make') }}" placeholder="напр. Volkswagen">
                @error('make')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Модел --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Модел <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('model') is-invalid @enderror"
                       name="model" value="{{ old('model') }}" placeholder="напр. Golf">
                @error('model')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Година --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Година <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('year') is-invalid @enderror"
                       name="year" value="{{ old('year') }}" min="1900" max="{{ date('Y') + 1 }}"
                       placeholder="напр. 2018">
                @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Регистрационен номер --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Регистрационен номер <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('plate') is-invalid @enderror"
                       name="plate" value="{{ old('plate') }}" placeholder="напр. СА1234АВ"
                       style="text-transform: uppercase;">
                @error('plate')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- VIN --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">VIN номер <small class="text-muted">(незадължително)</small></label>
                <input type="text" class="form-control @error('vin') is-invalid @enderror"
                       name="vin" value="{{ old('vin') }}" maxlength="17"
                       placeholder="17 символа">
                @error('vin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-floppy"></i> Запази
                </button>
                <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary">Отказ</a>
            </div>
        </form>
    </div>
</div>

@endsection
