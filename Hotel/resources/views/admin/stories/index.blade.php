<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container-fluid">
                        <h1 class="text-2xl font-bold mb-4">Stories</h1>

                        <!-- Success message display with Toastr -->
                        @if(session()->has('success'))
                            <script>
                                $(document).ready(function() {
                                    toastr.success("{{ session('success') }}");
                                });
                            </script>
                        @endif

                        <!-- Table displaying stories -->
                        <div>
                            <table border="1" class="table table-striped">
                                <tr>
                                    <th>ID</th>
                                    <th>Paragraph One</th>
                                    <th>Paragraph Two</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                @foreach ($stories as $story)
                                <tr>
                                    <td>{{ $story->id }}</td>
                                    <td>{{ $story->paragraph_one }}</td>
                                    <td>{{ $story->paragraph_two }}</td><td><img src="{{ asset('storage/' . $story->image) }}" alt="Image" style="width: 70px; height: 70px;"></td>
                                    <td>
                                        <a href="{{ route('about.edit', ['story' => $story->id]) }}" class="btn bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-500">Edit</a>

                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('about.delete', ['story' => $story->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-red-700 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @endforeach
                            
                            </table>
                        </div>

                        <!-- Create new story button -->
                        <div class="mt-4">
                            <a href="{{ route('about.create') }}" class="btn bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Create a New Story</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
