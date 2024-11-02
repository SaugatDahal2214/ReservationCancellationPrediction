<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Story') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Edit Story</h1>
                    <div>
                        @if($errors->any())
                        <ul class="text-red-500">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('about.update', $story->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="paragraph_one" class="block text-gray-700 text-sm font-bold mb-2">Paragraph One</label>
                            <textarea name="paragraph_one" id="paragraph_one" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('paragraph_one', $story->paragraph_one) }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="paragraph_two" class="block text-gray-700 text-sm font-bold mb-2">Paragraph Two</label>
                            <textarea name="paragraph_two" id="paragraph_two" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('paragraph_two', $story->paragraph_two) }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                            @if($story->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $story->image) }}" alt="Current Image" style="width: 100px; height: 100px;">
                                </div>
                            @endif
                            <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="mb-4">
                            <input type="submit" value="Update Story" class="bg-red-700 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
