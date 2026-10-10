<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RequestController extends Controller
{
    public function index(HttpRequest $httpRequest): View
    {
        $query = Request::with('user', 'category');

        if (in_array($httpRequest->query('status'), ['pending', 'approved', 'rejected'], true)) {
            $query->where('status', $httpRequest->query('status'));
        }

        if ($httpRequest->query('category')) {
            $query->where('category_id', $httpRequest->query('category'));
        }

        return view('admin.requests.index', [
            'requests' => $query->latest('request_date')->paginate(15)->withQueryString(),
            'categories' => Category::orderBy('name')->get(),
            'currentStatus' => $httpRequest->query('status'),
            'currentCategory' => $httpRequest->query('category'),
        ]);
    }

    public function show(Request $request): View
    {
        return view('admin.requests.show', [
            'request' => $request->load('user', 'category', 'approver'),
        ]);
    }

    public function approve(Request $request): RedirectResponse
    {
        $this->ensurePending($request);

        $request->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'decided_at' => now(),
        ]);

        return back()->with('status', 'Request approved.');
    }

    public function reject(Request $request): RedirectResponse
    {
        $this->ensurePending($request);

        $request->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'decided_at' => now(),
        ]);

        return back()->with('status', 'Request rejected.');
    }

    private function ensurePending(Request $request): void
    {
        if ($request->status !== 'pending') {
            throw new HttpException(422, 'This request has already been decided.');
        }
    }
}
