<x-layouts.app title="Request Detail">
    <div class="max-w-2xl mx-auto py-8 space-y-6">
        @if (session('status'))
            <div class="rounded border p-3">{{ session('status') }}</div>
        @endif

        <h1 class="text-2xl font-bold">{{ $request->title }}</h1>

        <dl class="space-y-2">
            <div><dt class="font-semibold">Status</dt><dd>{{ ucfirst($request->status) }}</dd></div>
            <div><dt class="font-semibold">Category</dt><dd>{{ $request->category->name }}</dd></div>
            <div><dt class="font-semibold">Quantity</dt><dd>{{ $request->quantity }}</dd></div>
            <div><dt class="font-semibold">Estimated cost</dt><dd>{{ number_format((float) $request->estimated_cost, 2) }}</dd></div>
            <div><dt class="font-semibold">Request date</dt><dd>{{ $request->request_date->format('d M Y') }}</dd></div>
            <div><dt class="font-semibold">Submitted by</dt><dd>{{ $request->user->name }}</dd></div>
            <div><dt class="font-semibold">Description</dt><dd>{{ $request->description }}</dd></div>
        </dl>

        <div class="flex items-center gap-4 pt-4">
            <a href="{{ route('requests.index') }}" class="underline">Back to my requests</a>

            @if ($request->status === 'pending')
                <a href="{{ route('requests.edit', $request) }}" class="underline">Edit</a>

                <form method="POST" action="{{ route('requests.destroy', $request) }}"
                      onsubmit="return confirm('Delete this request permanently?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="underline">Delete</button>
                </form>
            @endif
        </div>
    </div>
</x-layouts.app>
