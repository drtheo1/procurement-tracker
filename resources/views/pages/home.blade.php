<x-layouts::app title="Home">
    <div class="max-w-3xl mx-auto py-12 space-y-6">
        <h1 class="text-3xl font-bold">Procurement Request Tracker</h1>
        <p class="text-lg">
            Submit purchase requests, route them to the right approver, and track
            every decision in one place.
        </p>
        <ul class="list-disc list-inside space-y-1">
            <li>Employees raise requests for goods and services</li>
            <li>Managers review, approve, or reject</li>
            <li>Every request keeps a full status record</li>
        </ul>
        <div class="flex gap-4 pt-4">
            <a href="{{ route('register') }}" class="underline">Create an account</a>
            <a href="{{ route('login') }}" class="underline">Log in</a>
        </div>
    </div>
</x-layouts::app>
