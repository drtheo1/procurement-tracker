<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::withCount('requests')->orderBy('name')->paginate(15),
        ]);
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(HttpRequest $httpRequest, User $user): RedirectResponse
    {
        $this->ensureNotSelf($user);

        $validated = $httpRequest->validate([
            'role' => ['required', 'in:employee,manager,admin'],
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('status', "Role updated for {$user->name}.");
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->ensureNotSelf($user);

        if ($user->requests()->exists()) {
            return back()->with('status', 'This user has requests on record and cannot be deleted.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('status', "{$name} has been removed.");
    }

    private function ensureNotSelf(User $user): void
    {
        if ($user->id === Auth::id()) {
            throw new HttpException(403, 'You cannot change your own account here.');
        }
    }
}
