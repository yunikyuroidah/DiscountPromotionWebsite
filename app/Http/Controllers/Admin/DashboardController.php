<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use App\Models\VisitorLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $adminCount = Admin::query()->count();
        $productCount = Product::query()->count();

        $selectedMonth = $request->get('month') ?: now()->format('Y-m');
        $monthStart = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth();
        $monthEnd = $monthStart->copy()->endOfMonth();

        $labels = [1, 15, $monthEnd->day];
        $counts = VisitorLog::query()
            ->whereBetween('visited_at', [$monthStart, $monthEnd])
            ->selectRaw('DAY(visited_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->pluck('total', 'day');

        $visitorCount = VisitorLog::query()
            ->whereBetween('visited_at', [$monthStart, $monthEnd])
            ->count();

        $chartData = array_map(
            fn (int $day): int => (int) ($counts[$day] ?? 0),
            $labels
        );

        $monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];

        $monthOptions = [];
        for ($i = 0; $i < 12; $i++) {
            $date = now()->startOfMonth()->subMonths($i);
            $monthOptions[] = [
                'value' => $date->format('Y-m'),
                'label' => $monthNames[$date->month - 1] . ' ' . $date->year,
            ];
        }

        return view('admin.dashboard', [
            'adminCount' => $adminCount,
            'productCount' => $productCount,
            'visitorCount' => $visitorCount,
            'chartLabels' => $labels,
            'chartData' => $chartData,
            'monthOptions' => $monthOptions,
            'selectedMonth' => $selectedMonth,
        ]);
    }
}
