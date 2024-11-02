<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rooms') }}
        </h2>
    </x-slot>

    <div class="container-fluid py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                        <h1 class="text-2xl font-bold mb-4">Edit Room</h1>
                        <div class="mb-4">
                            @if($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-600">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        
                        <form method="POST" action="{{ route('rooms.update', $room->id) }}" enctype="multipart/form-data" class="card-body">
                            @csrf
                            @method('PUT')
                
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $room->title) }}" placeholder="Room Title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>
                
                            <div class="mb-4">
                                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                                <select id="type" name="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                    <option value="" disabled>Select Room Type</option>
                                    <option value="Single" {{ $room->type === 'Single' ? 'selected' : '' }}>Single</option>
                                    <option value="Double" {{ $room->type === 'Double' ? 'selected' : '' }}>Double</option>
                                    <option value="Suite" {{ $room->type === 'Suite' ? 'selected' : '' }}>Suite</option>
                                    <option value="Deluxe" {{ $room->type === 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                                    <option value="Family" {{ $room->type === 'Family' ? 'selected' : '' }}>Family</option>
                                    <option value="Executive" {{ $room->type === 'Executive' ? 'selected' : '' }}>Executive</option>
                                    <option value="Presidential" {{ $room->type === 'Presidential' ? 'selected' : '' }}>Presidential</option>
                                </select>
                            </div>
                
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" name="description" rows="4" placeholder="Room Description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('description', $room->description) }}</textarea>
                            </div>
                
                            <div class="mb-4">
                                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                <input type="file" id="image" name="image" class="form-input mt-1 block w-full rounded-md border-gray-300" accept="image/*">
                                @if($room->image)
                                    <img src="{{ asset('storage/' . $room->image) }}" alt="Current Image" class="mt-2" style="width: 100px; height: auto;">
                                @endif
                            </div>
                
                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                                <input type="number" id="price" name="price" value="{{ old('price', $room->price) }}" placeholder="Room Price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" step="0.01" required>
                            </div>
                
                            <div>
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update Room</button>
                            </div>
                        </form>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</x-app-layout>
