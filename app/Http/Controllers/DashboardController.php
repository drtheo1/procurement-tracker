<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user !== null && $user->canApproveRequests()) {
            return redirect()->route('admin.dashboard');
        }

        $base = Request::where('user_id', Auth::id());

        return view('dashboard', [
            'pendingCount' => (clone $base)->where('status', 'pending')->count(),
            'approvedCount' => (clone $base)->where('status', 'approved')->count(),
            'rejectedCount' => (clone $base)->where('status', 'rejected')->count(),
            'recent' => (clone $base)->with('category')->latest('request_date')->take(5)->get(),
        ]);
    }
}
