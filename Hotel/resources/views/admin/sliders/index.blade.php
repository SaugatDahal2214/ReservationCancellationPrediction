<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Slider') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container-fluid">
                        <h1 class="text-2xl font-bold mb-4">Sliders</h1>
                        <div>
                            @if(session()->has('success'))
                                <script>
                                    $(document).ready(function() {
                                        toastr.success("{{ session('success') }}");
                                    });
                                </script>
                            @endif
                        </div>
                        
                    <div>
                        <table border="1" class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{$slider->id}}</td>
                                    <td>{{$slider->title}}</td>
                                    <td>{{$slider->description}}</td>
                                    <td><img src="{{asset($slider->image)}}" alt="Image" style="width: 70px; height:70px"></td>
                                    
                                    <td>
                                        <form action="{{ route('slider.edit', ['slider' => $slider]) }}" method="GET">
                                            <button type="submit" class="btn  bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</button>
                                        </form>                        
                                    </td>
                                    <td><form method="post" action="{{route('slider.delete', ['slider' => $slider])}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn  bg-red-700 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div>
                        <a href="{{ route('slider.create') }}" class="btn btn- bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Create a New Slider</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
