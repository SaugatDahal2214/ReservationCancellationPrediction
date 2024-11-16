@extends('users.master')

@section('content')

<body>
    <div class="container my-5">
        <h2 class="our-stories text-center pb-5">
            Book a <span class="green-text">Room</span>
        </h2>

        <!-- Display success message if booking was successful -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display validation errors -->
        @if ($errors->any())
            <ul class="list-disc pl-5 text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <!-- Booking Form -->
        <form action="{{ route('booking.submit') }}" method="POST" class="shadow p-4 rounded bg-light mx-auto" style="max-width: 600px;">
            @csrf
          
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="no_of_adults" class="form-label">Number of Adults</label>
                    <input type="number" id="no_of_adults" name="no_of_adults" class="form-control" min="1" required value="{{ old('no_of_adults') }}">
                </div>
                <div class="col-md-6">
                    <label for="no_of_children" class="form-label">Number of Children</label>
                    <input type="number" id="no_of_children" name="no_of_children" class="form-control" min="0" required value="{{ old('no_of_children') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="check_in_date" class="form-label">Check-In Date</label>
                    <input type="date" id="check_in_date" name="check_in_date" class="form-control" required value="{{ old('check_in_date') }}">
                </div>
                <div class="col-md-6">
                    <label for="check_out_date" class="form-label">Check-Out Date</label>
                    <input type="date" id="check_out_date" name="check_out_date" class="form-control" required value="{{ old('check_out_date') }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="meal_type" class="form-label">Meal Type</label>
                <select id="meal_type" name="meal_type" class="form-select" required>
                    <option value="0" {{ old('meal_type') == '0' ? 'selected' : '' }}>Breakfast</option>
                    <option value="1" {{ old('meal_type') == '1' ? 'selected' : '' }}>Lunch</option>
                    <option value="2" {{ old('meal_type') == '2' ? 'selected' : '' }}>Dinner</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Special Requests:</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="special_requests[]" value="Extra Towels">
                    <label class="form-check-label">Extra Towels</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="special_requests[]" value="Late Checkout">
                    <label class="form-check-label">Late Checkout</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="special_requests[]" value="Room Decoration">
                    <label class="form-check-label">Room Decoration</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="special_requests[]" value="Airport Pickup">
                    <label class="form-check-label">Airport Pickup</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="special_requests[]" value="High Floor">
                    <label class="form-check-label">High Floor</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="required_car_parking_space" class="form-label">Required Car Parking Space</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="required_car_parking_space" name="required_car_parking_space" value="1">
                    <label class="form-check-label" for="required_car_parking_space">Yes</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="room_type_reserved" class="form-label">Room Type Reserved</label>
                <input type="text" id="room_type_reserved" name="room_type_reserved" class="form-control" value="{{ $room_type }}" readonly>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" id="price" name="price" class="form-control" value="{{ $price }}" readonly>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="depart-button btn btn-primary w-100">Submit Booking</button>
        </form>
    </div>
</body>

@endsection
