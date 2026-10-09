<x-layouts.app title="Edit Request">
    <div class="max-w-2xl mx-auto py-8 space-y-6">
        <h1 class="text-2xl font-bold">Edit request</h1>

        <form method="POST" action="{{ route('requests.update', $request) }}" class="space-y-4">
            @csrf
            @method('PUT')
            @include('requests.form')
            <button type="submit" class="border rounded px-4 py-2">Save changes</button>
            <a href="{{ route('requests.show', $request) }}" class="underline ml-3">Cancel</a>
        </form>
    </div>
</x-layouts.app>
