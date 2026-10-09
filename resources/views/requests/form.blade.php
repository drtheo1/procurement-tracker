<div>
    <label for="title" class="block mb-1">Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', $request?->title) }}" class="w-full border rounded p-2" required>
    @error('title') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div>
    <label for="description" class="block mb-1">Description</label>
    <textarea id="description" name="description" rows="4" class="w-full border rounded p-2" required>{{ old('description', $request?->description) }}</textarea>
    @error('description') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div>
    <label for="category_id" class="block mb-1">Category</label>
    <select id="category_id" name="category_id" class="w-full border rounded p-2" required>
        <option value="">Choose a category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $request?->category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div>
    <label for="quantity" class="block mb-1">Quantity</label>
    <input type="number" id="quantity" name="quantity" min="1" value="{{ old('quantity', $request?->quantity) }}" class="w-full border rounded p-2" required>
    @error('quantity') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div>
    <label for="estimated_cost" class="block mb-1">Estimated cost</label>
    <input type="number" step="0.01" min="0" id="estimated_cost" name="estimated_cost" value="{{ old('estimated_cost', $request?->estimated_cost) }}" class="w-full border rounded p-2" required>
    @error('estimated_cost') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div>
    <label for="request_date" class="block mb-1">Request date</label>
    <input type="date" id="request_date" name="request_date" value="{{ old('request_date', $request?->request_date?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" class="w-full border rounded p-2" required>
    @error('request_date') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
</div>
