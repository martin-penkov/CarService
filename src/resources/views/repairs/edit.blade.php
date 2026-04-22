@extends('layouts.app')

@section('title', 'Редактирай ремонт')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('repairs.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="fw-bold mb-0"><i class="bi bi-pencil-square text-warning"></i> Редактиране на ремонт</h2>
</div>

<div class="card" style="max-width: 650px;">
    <div class="card-body">
        <form action="{{ route('repairs.update', $repair->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Кола <span class="text-danger">*</span></label>
                <select class="form-select @error('car_id') is-invalid @enderror" name="car_id">
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}" {{ old('car_id', $repair->car_id) == $car->id ? 'selected' : '' }}>
                            {{ $car->make }} {{ $car->model }} - {{ $car->plate }}
                        </option>
                    @endforeach
                </select>
                @error('car_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Услуга <span class="text-danger">*</span></label>
                <select class="form-select @error('service_id') is-invalid @enderror" name="service_id">
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id', $repair->service_id) == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} ({{ $service->price }} лв.)
                        </option>
                    @endforeach
                </select>
                @error('service_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Дата на ремонта <span class="text-danger">*</span></label>
                <input type="date" class="form-control @error('repair_date') is-invalid @enderror"
                       name="repair_date" value="{{ old('repair_date', $repair->repair_date) }}">
                @error('repair_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Крайна цена (лв.) <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('total_price') is-invalid @enderror"
                       name="total_price" value="{{ old('total_price', $repair->total_price) }}"
                       min="0" step="0.01">
                @error('total_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Километраж</label>
                <input type="number" class="form-control @error('mileage') is-invalid @enderror"
                       name="mileage" value="{{ old('mileage', $repair->mileage) }}" min="0">
                @error('mileage')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Статус <span class="text-danger">*</span></label>
                <select class="form-select @error('status') is-invalid @enderror" name="status">
                    <option value="pending"     {{ old('status', $repair->status) == 'pending'     ? 'selected' : '' }}>Изчакване</option>
                    <option value="in_progress" {{ old('status', $repair->status) == 'in_progress' ? 'selected' : '' }}>В процес</option>
                    <option value="completed"   {{ old('status', $repair->status) == 'completed'   ? 'selected' : '' }}>Завършен</option>
                    <option value="cancelled"   {{ old('status', $repair->status) == 'cancelled'   ? 'selected' : '' }}>Отказан</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Бележки</label>
                <textarea class="form-control @error('notes') is-invalid @enderror"
                          name="notes" rows="3">{{ old('notes', $repair->notes) }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-floppy"></i> Обнови
                </button>
                <a href="{{ route('repairs.index') }}" class="btn btn-outline-secondary">Отказ</a>
            </div>
        </form>
    </div>
</div>

@endsection
