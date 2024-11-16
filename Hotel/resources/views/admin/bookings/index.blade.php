<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bookings') }}
        </h2>
    </x-slot>

    <div class="container-fluid py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Booking List</h1>

                    <!-- Success message display with Toastr -->
                    @if(session()->has('success'))
                        <script>
                            $(document).ready(function() {
                                toastr.success("{{ session('success') }}");
                            });
                        </script>
                    @endif

                    <!-- Table displaying bookings -->
                    <table class="min-w-full border-collapse block md:table">
                        <thead class="block md:table-header-group">
                            <tr class="border border-gray-300 md:border-none block md:table-row">
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Booking ID</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Email</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Check-In</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Check-Out</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Room Type</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Adults</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Children</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Meal Type</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Lead Time</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Price</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Special Requests</th>
                                <th class="border border-gray-300 md:border-none block md:table-cell text-left p-2">Repeated Customer</th>
                            </tr>
                        </thead>
                        <tbody class="block md:table-row-group">
                            @foreach ($bookings as $booking)
                                <tr class="border border-gray-300 md:border-none block md:table-row">
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $booking->id }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $booking->email }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $booking->check_in_date->format('Y-m-d') }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $booking->check_out_date->format('Y-m-d') }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $booking->room_type_reserved }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $booking->no_of_adults }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $booking->no_of_children }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $booking->meal_type }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">{{ $booking->lead_time }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">${{ number_format($booking->price, 2) }}</td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">
                                        {{ implode(', ', json_decode($booking->special_requests, true) ?? []) }}
                                    </td>
                                    <td class="border border-gray-300 md:border-none block md:table-cell p-2">
                                        {{ $booking->repeated_customer ? 'Yes' : 'No' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
