<x-layouts.app title="New Request">
    <div class="max-w-2xl mx-auto py-8 space-y-6">
        <h1 class="text-2xl font-bold">New request</h1>

        <form method="POST" action="{{ route('requests.store') }}" class="space-y-4">
            @csrf
            @include('requests.form', ['request' => null])
            <button type="submit" class="border rounded px-4 py-2">Submit request</button>
            <a href="{{ route('requests.index') }}" class="underline ml-3">Cancel</a>
        </form>
    </div>
</x-layouts.app>
