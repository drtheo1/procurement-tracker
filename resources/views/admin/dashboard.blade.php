<x-layouts.app title="Admin Dashboard">
    <div class="max-w-5xl mx-auto py-8 space-y-8">
        <h1 class="text-2xl font-bold">Dashboard</h1>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
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
            <div class="border rounded p-4">
                <p class="text-sm">Users</p>
                <p class="text-2xl font-bold">{{ $userCount }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="border rounded p-4">
                <p class="text-sm">Value awaiting decision</p>
                <p class="text-xl font-bold">{{ number_format($pendingValue, 2) }}</p>
            </div>
            <div class="border rounded p-4">
                <p class="text-sm">Value approved</p>
                <p class="text-xl font-bold">{{ number_format($approvedValue, 2) }}</p>
            </div>
        </div>

        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Longest waiting</h2>
                <a href="{{ route('admin.requests.index') }}" class="underline">All requests</a>
            </div>

            @if ($oldestPending->isEmpty())
                <p>Nothing is awaiting a decision.</p>
            @else
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Title</th>
                            <th class="py-2">Submitted by</th>
                            <th class="py-2">Category</th>
                            <th class="py-2">Cost</th>
                            <th class="py-2">Date</th>
                            <th class="py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($oldestPending as $item)
                            <tr class="border-b">
                                <td class="py-2">{{ $item->title }}</td>
                                <td class="py-2">{{ $item->user->name }}</td>
                                <td class="py-2">{{ $item->category->name }}</td>
                                <td class="py-2">{{ number_format((float) $item->estimated_cost, 2) }}</td>
                                <td class="py-2">{{ $item->request_date->format('d M Y') }}</td>
                                <td class="py-2"><a href="{{ route('admin.requests.show', $item) }}" class="underline">Review</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-layouts.app>
