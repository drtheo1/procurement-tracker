<x-layouts.app title="Review Request">
    <div class="max-w-2xl mx-auto py-8 space-y-6">
        @if (session('status'))
            <div class="rounded border p-3">{{ session('status') }}</div>
        @endif

        <h1 class="text-2xl font-bold">{{ $request->title }}</h1>

        <dl class="space-y-2">
            <div><dt class="font-semibold">Status</dt><dd>{{ ucfirst($request->status) }}</dd></div>
            <div><dt class="font-semibold">Submitted by</dt><dd>{{ $request->user->name }}</dd></div>
            <div><dt class="font-semibold">Category</dt><dd>{{ $request->category->name }}</dd></div>
            <div><dt class="font-semibold">Quantity</dt><dd>{{ $request->quantity }}</dd></div>
            <div><dt class="font-semibold">Estimated cost</dt><dd>{{ number_format((float) $request->estimated_cost, 2) }}</dd></div>
            <div><dt class="font-semibold">Request date</dt><dd>{{ $request->request_date->format('d M Y') }}</dd></div>
            <div><dt class="font-semibold">Description</dt><dd>{{ $request->description }}</dd></div>
        </dl>

        @if ($request->status === 'pending')
            <div class="flex gap-3 pt-4">
                <form method="POST" action="{{ route('admin.requests.approve', $request) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="border rounded px-4 py-2">Approve</button>
                </form>

                <form method="POST" action="{{ route('admin.requests.reject', $request) }}"
                      onsubmit="return confirm('Reject this request?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="border rounded px-4 py-2">Reject</button>
                </form>
            </div>
        @else
            <p class="pt-4">This request has already been decided and cannot be changed.</p>
        @endif

        <a href="{{ route('admin.requests.index') }}" class="underline block pt-4">Back to all requests</a>
    </div>
</x-layouts.app>
