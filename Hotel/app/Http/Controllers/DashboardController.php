<?php

namespace App\Http\Controllers;
use App\Models\Prediction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
{
    // Aggregate predictions using the correct column
    $predictionCounts = Prediction::selectRaw('prediction_output, COUNT(*) as count')
        ->groupBy('prediction_output')
        ->pluck('count', 'prediction_output');

    // Prepare counts for chart (defaulting to 0 if a prediction type is missing)
    $totalZero = $predictionCounts[0] ?? 0;
    $totalOne = $predictionCounts[1] ?? 0;

    return view('dashboard', compact('totalZero', 'totalOne'));
}


}
