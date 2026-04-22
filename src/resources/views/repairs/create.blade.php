@extends('layouts.app')

@section('title', 'Нов ремонт')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('repairs.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="fw-bold mb-0"><i class="bi bi-plus-circle text-warning"></i> Нов ремонт</h2>
</div>

<div class="card" style="max-width: 650px;">
    <div class="card-body">
        <form action="{{ route('repairs.store') }}" method="POST">
            @csrf

            {{-- Кола --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Кола <span class="text-danger">*</span></label>
                <select class="form-select @error('car_id') is-invalid @enderror" name="car_id">
                    <option value="">-- Изберете кола --</option>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                            {{ $car->make }} {{ $car->model }} - {{ $car->plate }} ({{ $car->year }})
                        </option>
                    @endforeach
                </select>
                @error('car_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Услуга --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Услуга <span class="text-danger">*</span></label>
                <select class="form-select @error('service_id') is-invalid @enderror" name="service_id"
                        onchange="fillPrice(this)">
                    <option value="">-- Изберете услуга --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}"
                                data-price="{{ $service->price }}"
                                {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} ({{ $service->price }} лв.)
                        </option>
                    @endforeach
                </select>
                @error('service_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Дата --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Дата на ремонта <span class="text-danger">*</span></label>
                <input type="date" class="form-control @error('repair_date') is-invalid @enderror"
                       name="repair_date" value="{{ old('repair_date', date('Y-m-d')) }}">
                @error('repair_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Крайна цена --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Крайна цена (лв.) <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('total_price') is-invalid @enderror"
                       name="total_price" id="total_price"
                       value="{{ old('total_price', 0) }}" min="0" step="0.01">
                @error('total_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Километраж --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Километраж <small class="text-muted">(незадължително)</small></label>
                <input type="number" class="form-control @error('mileage') is-invalid @enderror"
                       name="mileage" value="{{ old('mileage') }}" min="0" placeholder="напр. 150000">
                @error('mileage')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Статус --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Статус <span class="text-danger">*</span></label>
                <select class="form-select @error('status') is-invalid @enderror" name="status">
                    <option value="pending"     {{ old('status', 'pending') == 'pending'     ? 'selected' : '' }}>Изчакване</option>
                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>В процес</option>
                    <option value="completed"   {{ old('status') == 'completed'   ? 'selected' : '' }}>Завършен</option>
                    <option value="cancelled"   {{ old('status') == 'cancelled'   ? 'selected' : '' }}>Отказан</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Бележки --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Бележки на механика <small class="text-muted">(незадължително)</small></label>
                <textarea class="form-control @error('notes') is-invalid @enderror"
                          name="notes" rows="3"
                          placeholder="Описание на извършените дейности...">{{ old('notes') }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-floppy"></i> Запази
                </button>
                <a href="{{ route('repairs.index') }}" class="btn btn-outline-secondary">Отказ</a>
            </div>
        </form>
    </div>
</div>

<script>
// Автоматично попълване на цената при избор на услуга
function fillPrice(select) {
    const option = select.options[select.selectedIndex];
    const price = option.getAttribute('data-price');
    if (price) {
        document.getElementById('total_price').value = price;
    }
}
</script>

@endsection
