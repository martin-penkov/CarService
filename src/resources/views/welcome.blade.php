@extends('layouts.app')

@section('title', 'Начало')

@section('content')

<div class="text-center py-5">
    <i class="bi bi-wrench-adjustable-circle-fill text-warning" style="font-size: 4rem;"></i>
    <h1 class="mt-3 fw-bold">АвтоСервиз</h1>
    <p class="lead text-muted">Система за управление на автосервиз</p>

    @guest
        <div class="mt-4 d-flex gap-3 justify-content-center">
            <a href="{{ route('login') }}" class="btn btn-dark btn-lg px-4">
                <i class="bi bi-box-arrow-in-right"></i> Вход
            </a>
            <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-4">
                <i class="bi bi-person-plus"></i> Регистрация
            </a>
        </div>
    @else
        <a href="{{ route('dashboard') }}" class="btn btn-dark btn-lg px-4 mt-4">
            <i class="bi bi-speedometer2"></i> Към таблото
        </a>
    @endguest
</div>

{{-- Последни 5 ремонта --}}
@isset($recentRepairs)
<div class="card mx-auto" style="max-width: 700px;">
    <div class="card-header bg-dark text-white">
        <i class="bi bi-clock-history"></i> Последни ремонти
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Кола</th>
                    <th>Услуга</th>
                    <th>Дата</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentRepairs as $repair)
                <tr>
                    <td>{{ $repair->car->make }} {{ $repair->car->model }}</td>
                    <td>{{ $repair->service->name }}</td>
                    <td>{{ $repair->repair_date }}</td>
                    <td>
                        <span class="badge bg-{{ $repair->statusClass() }}">
                            {{ $repair->statusLabel() }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">Няма записи.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endisset

@endsection
