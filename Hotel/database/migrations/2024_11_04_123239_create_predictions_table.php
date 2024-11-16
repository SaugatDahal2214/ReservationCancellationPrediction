<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredictionsTable extends Migration
{
    public function up()
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('room_type_reserved');
            $table->decimal('price', 8, 2);
            $table->json('special_requests')->nullable(); // Store special requests in JSON format
            $table->string('prediction_output'); // Store the output from the prediction script
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('predictions');
    }
}
