<x-layouts.app title="My Requests">
    <div class="max-w-5xl mx-auto py-8 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">My requests</h1>
            <a href="{{ route('requests.create') }}" class="underline">New request</a>
        </div>

        @if (session('status'))
            <div class="rounded border p-3">{{ session('status') }}</div>
        @endif

        @if ($requests->isEmpty())
            <p>You have not submitted any requests yet.</p>
        @else
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">Title</th>
                        <th class="py-2">Category</th>
                        <th class="py-2">Quantity</th>
                        <th class="py-2">Estimated cost</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Date</th>
                        <th class="py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $item)
                        <tr class="border-b">
                            <td class="py-2">{{ $item->title }}</td>
                            <td class="py-2">{{ $item->category->name }}</td>
                            <td class="py-2">{{ $item->quantity }}</td>
                            <td class="py-2">{{ number_format((float) $item->estimated_cost, 2) }}</td>
                            <td class="py-2">{{ ucfirst($item->status) }}</td>
                            <td class="py-2">{{ $item->request_date->format('d M Y') }}</td>
                            <td class="py-2"><a href="{{ route('requests.show', $item) }}" class="underline">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div>{{ $requests->links() }}</div>
        @endif
    </div>
</x-layouts.app>
