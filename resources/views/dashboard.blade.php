<x-layouts.app title="Dashboard">
    <div class="max-w-4xl mx-auto py-8 space-y-8">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Welcome, {{ auth()->user()->name }}</h1>
            <a href="{{ route('requests.create') }}" class="border rounded px-4 py-2">New request</a>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="border rounded p-4">
                <p class="text-sm">Pending</p>
                <p class="text-2xl font-bold">{{ $pendingCount }}</p>
            </div>
            <div class="border rounded p-4">
                <p class="text-sm">Approved</p>
                <p class="text-2xl font-bold">{{ $approvedCount }}</p>
            </div>
            <div class="border rounded p-4">
                <p class="text-sm">Rejected</p>
                <p class="text-2xl font-bold">{{ $rejectedCount }}</p>
            </div>
        </div>

        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Recent requests</h2>
                <a href="{{ route('requests.index') }}" class="underline">See all</a>
            </div>

            @if ($recent->isEmpty())
                <p>You have not submitted any requests yet.</p>
            @else
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Title</th>
                            <th class="py-2">Category</th>
                            <th class="py-2">Cost</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recent as $item)
                            <tr class="border-b">
                                <td class="py-2"><a href="{{ route('requests.show', $item) }}" class="underline">{{ $item->title }}</a></td>
                                <td class="py-2">{{ $item->category->name }}</td>
                                <td class="py-2">{{ number_format((float) $item->estimated_cost, 2) }}</td>
                                <td class="py-2">{{ ucfirst($item->status) }}</td>
                                <td class="py-2">{{ $item->request_date->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-layouts.app>
