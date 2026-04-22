<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Repair;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars     = Car::count();
        $totalRepairs  = Repair::count();
        $totalServices = Service::count();
        $totalRevenue  = Repair::where('status', 'completed')->sum('total_price');

        $recentRepairs = Repair::with(['car', 'service'])
            ->latest()
            ->limit(10)
            ->get();

        $pendingRepairs = Repair::where('status', 'pending')->count();
        $inProgressRepairs = Repair::where('status', 'in_progress')->count();

        return view('dashboard', compact(
            'totalCars',
            'totalRepairs',
            'totalServices',
            'totalRevenue',
            'recentRepairs',
            'pendingRepairs',
            'inProgressRepairs'
        ));
    }
}
