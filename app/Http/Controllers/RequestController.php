<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RequestController extends Controller
{
    public function index(): View
    {
        $requests = Request::where('user_id', Auth::id())
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('requests.index', ['requests' => $requests]);
    }

    public function create(): View
    {
        return view('requests.create', ['categories' => Category::orderBy('name')->get()]);
    }

    public function store(HttpRequest $httpRequest): RedirectResponse
    {
        $validated = $httpRequest->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'quantity' => ['required', 'integer', 'min:1'],
            'estimated_cost' => ['required', 'numeric', 'min:0'],
            'request_date' => ['required', 'date'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Request::create($validated);

        return redirect()->route('requests.index')
            ->with('status', 'Your request has been submitted.');
    }

    public function show(Request $request): View
    {
        $this->authoriseOwner($request);

        return view('requests.show', ['request' => $request->load('category', 'user', 'approver')]);
    }

    public function edit(Request $request): View
    {
        $this->authoriseOwner($request);
        $this->authorisePending($request);

        return view('requests.edit', [
            'request' => $request,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(HttpRequest $httpRequest, Request $request): RedirectResponse
    {
        $this->authoriseOwner($request);
        $this->authorisePending($request);

        $validated = $httpRequest->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'quantity' => ['required', 'integer', 'min:1'],
            'estimated_cost' => ['required', 'numeric', 'min:0'],
            'request_date' => ['required', 'date'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $request->update($validated);

        return redirect()->route('requests.show', $request)
            ->with('status', 'Your request has been updated.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $this->authoriseOwner($request);
        $this->authorisePending($request);

        $request->delete();

        return redirect()->route('requests.index')
            ->with('status', 'Your request has been deleted.');
    }

    private function authoriseOwner(Request $request): void
    {
        if ($request->user_id !== Auth::id()) {
            throw new HttpException(403, 'This request belongs to another user.');
        }
    }

    private function authorisePending(Request $request): void
    {
        if ($request->status !== 'pending') {
            throw new HttpException(403, 'A request can only be changed while it is pending.');
        }
    }
}
