<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorController extends Controller
{
    public function index(Request $request): View
    {
        $query = VisitorLog::query();

        $path = trim((string) $request->get('path', ''));
        if ($path !== '') {
            $query->where('path', 'like', "%{$path}%");
        }

        $date = trim((string) $request->get('date', ''));
        if ($date !== '') {
            $query->whereDate('visited_at', $date);
        }

        $logs = $query
            ->orderByDesc('visited_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.visitors.index', [
            'logs' => $logs,
        ]);
    }
}
