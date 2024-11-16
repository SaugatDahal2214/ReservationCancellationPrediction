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
                    <h1 class="text-2xl font-bold mb-4">Room List</h1>

                    <!-- Success message display with Toastr -->
                    @if(session()->has('success'))
                        <script>
                            $(document).ready(function() {
                                toastr.success("{{ session('success') }}");
                            });
                        </script>
                    @endif

                    <!-- Table displaying rooms -->
                    <table class="min-w-full border-collapse block md:table">
                        <thead class="block md:table-header-group">
                            <tr class="border border-gray-300 md:border-none block md:table-row">
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">ID</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Title</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Type</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Description</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Image</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Price</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Edit</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Delete</th>
                            </tr>
                        </thead>
                        <tbody class="block md:table-row-group">
                            @foreach ($rooms as $room)
                                <tr class="border border-gray-300 md:border-none block md:table-row">
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $room->id }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $room->title }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $room->type_as_string }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $room->description }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">
                                        @if($room->image)
                                            <img src="{{ asset('storage/' . $room->image) }}" alt="Room Image" style="width: 70px; height: 70px;">
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">${{ number_format($room->price, 2) }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">
                                        <a href="{{ route('rooms.edit', ['room' => $room->id]) }}" class="btn bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-500">Edit</a>
                                    </td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">
                                        <form method="POST" action="{{ route('rooms.delete', ['room' => $room->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-red-700 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Create new room button -->
                    <div class="mt-4">
                        <a href="{{ route('rooms.create') }}" class="btn bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Create a New Room</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
