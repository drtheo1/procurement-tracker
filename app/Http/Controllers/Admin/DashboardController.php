<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'pendingCount' => Request::where('status', 'pending')->count(),
            'approvedCount' => Request::where('status', 'approved')->count(),
            'rejectedCount' => Request::where('status', 'rejected')->count(),
            'pendingValue' => (float) Request::where('status', 'pending')->sum('estimated_cost'),
            'approvedValue' => (float) Request::where('status', 'approved')->sum('estimated_cost'),
            'userCount' => User::count(),
            'oldestPending' => Request::where('status', 'pending')
                ->with('user', 'category')
                ->oldest('request_date')
                ->take(5)
                ->get(),
        ]);
    }
}
