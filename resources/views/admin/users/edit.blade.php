<x-layouts.app title="Edit User Role">
    <div class="max-w-xl mx-auto py-8 space-y-6">
        <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
        <p>{{ $user->email }}</p>

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="role" class="block mb-1">Role</label>
                <select id="role" name="role" class="w-full border rounded p-2" required>
                    @foreach (['employee', 'manager', 'admin'] as $role)
                        <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
                @error('role') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="border rounded px-4 py-2">Save role</button>
            <a href="{{ route('admin.users.index') }}" class="underline ml-3">Cancel</a>
        </form>

        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="pt-6 border-t"
              onsubmit="return confirm('Remove this user permanently?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="underline">Remove this user</button>
        </form>
    </div>
</x-layouts.app>
