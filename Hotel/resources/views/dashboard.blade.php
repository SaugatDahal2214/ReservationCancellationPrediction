<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Prediction Summary</h3>
                    <div class="chart-container" style="position: relative; height:300px; width:300px; margin:auto;">
                        <canvas id="predictionSummaryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pass PHP data to JavaScript
        const totalZero = @json($totalZero);
        const totalOne = @json($totalOne);

        // Render the chart
        const ctx = document.getElementById('predictionSummaryChart').getContext('2d');
        const predictionSummaryChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Low Risk (0)', 'High Risk (1)'],
                datasets: [{
                    label: 'Prediction Counts',
                    data: [totalZero, totalOne],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)', // Blue for 0
                        'rgba(255, 99, 132, 0.6)', // Red for 1
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                return `${label}: ${value}`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
