<x-layouts.app title="All Requests">
    <div class="max-w-6xl mx-auto py-8 space-y-6">
        <h1 class="text-2xl font-bold">All requests</h1>

        @if (session('status'))
            <div class="rounded border p-3">{{ session('status') }}</div>
        @endif

        <form method="GET" action="{{ route('admin.requests.index') }}" class="flex flex-wrap gap-3 items-end">
            <div>
                <label for="status" class="block text-sm mb-1">Status</label>
                <select id="status" name="status" class="border rounded p-2">
                    <option value="">All</option>
                    @foreach (['pending', 'approved', 'rejected'] as $status)
                        <option value="{{ $status }}" @selected($currentStatus === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="category" class="block text-sm mb-1">Category</label>
                <select id="category" name="category" class="border rounded p-2">
                    <option value="">All</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) $currentCategory === (string) $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="border rounded px-4 py-2">Filter</button>
            <a href="{{ route('admin.requests.index') }}" class="underline">Reset</a>
        </form>

        @if ($requests->isEmpty())
            <p>No requests match these filters.</p>
        @else
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">Title</th>
                        <th class="py-2">Submitted by</th>
                        <th class="py-2">Category</th>
                        <th class="py-2">Qty</th>
                        <th class="py-2">Cost</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Date</th>
                        <th class="py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $item)
                        <tr class="border-b">
                            <td class="py-2">{{ $item->title }}</td>
                            <td class="py-2">{{ $item->user->name }}</td>
                            <td class="py-2">{{ $item->category->name }}</td>
                            <td class="py-2">{{ $item->quantity }}</td>
                            <td class="py-2">{{ number_format((float) $item->estimated_cost, 2) }}</td>
                            <td class="py-2">{{ ucfirst($item->status) }}</td>
                            <td class="py-2">{{ $item->request_date->format('d M Y') }}</td>
                            <td class="py-2"><a href="{{ route('admin.requests.show', $item) }}" class="underline">Review</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div>{{ $requests->links() }}</div>
        @endif
    </div>
</x-layouts.app>
