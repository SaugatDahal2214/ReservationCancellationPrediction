@extends('users.master')

@section('content')


<section class="Departments-home py-5" id="rooms">
    <div class="container">
        <h2 class="our-stories text-center pb-5">
            Our <span class="green-text">Rooms</span>
        </h2>
        <div class="row text-center my-3">
            @foreach ($rooms as $room)
                <div class="col-sm-6 col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <img class="depart-image rounded mb-4" src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->title }}" />
                            <div class="depart-name text-center mt-2">{{ $room->type_as_string }}</div>
                            <div class="text-center mt-2">{{ $room->description }}</div>
                            <div class="mt-auto">
                                <a class="depart-button btn btn-primary bg-red-700 mt-3" href="{{ route('booking.form', ['room_type' => $room->type_as_string, 'price' => $room->price]) }}">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
   
@endsection