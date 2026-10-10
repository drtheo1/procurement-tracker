<x-layouts.app title="Users">
    <div class="max-w-5xl mx-auto py-8 space-y-6">
        <h1 class="text-2xl font-bold">Users</h1>

        @if (session('status'))
            <div class="rounded border p-3">{{ session('status') }}</div>
        @endif

        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Name</th>
                    <th class="py-2">Email</th>
                    <th class="py-2">Role</th>
                    <th class="py-2">Requests</th>
                    <th class="py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b">
                        <td class="py-2">{{ $user->name }}</td>
                        <td class="py-2">{{ $user->email }}</td>
                        <td class="py-2">{{ ucfirst($user->role) }}</td>
                        <td class="py-2">{{ $user->requests_count }}</td>
                        <td class="py-2">
                            @if ($user->id !== auth()->id())
                                <a href="{{ route('admin.users.edit', $user) }}" class="underline">Edit role</a>
                            @else
                                <span class="text-sm">This is you</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>{{ $users->links() }}</div>
    </div>
</x-layouts.app>
