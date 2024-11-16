<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSpecialRequestsFromBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('special_requests');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->json('special_requests')->nullable(); // Modify the type if it was different
        });
    }
}
