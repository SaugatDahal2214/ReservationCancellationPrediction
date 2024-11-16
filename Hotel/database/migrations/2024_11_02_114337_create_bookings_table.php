<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('no_of_adults');
            $table->integer('no_of_children');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->string('meal_type');
            $table->boolean('repeated_customer')->default(false);
            $table->json('special_requests')->nullable(); // stores an array of special requests
            $table->decimal('price', 10, 2);
            $table->integer('lead_time')->nullable(); // days between booking and check-in
            $table->integer('arrival_month')->nullable(); // month of check-in
            $table->integer('arrival_date')->nullable(); // day of check-in
            $table->integer('no_of_weekdays')->nullable();
            $table->integer('no_of_weekend_days')->nullable();
            $table->string('email')->index();
            $table->integer('no_of_previous_cancellations')->default(0); // cancellations by the user
            $table->integer('no_of_previous_bookings_not_canceled')->default(0); // successful bookings
            $table->boolean('booking_status')->default(0); // e.g., 0 for pending, 1 for confirmed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
