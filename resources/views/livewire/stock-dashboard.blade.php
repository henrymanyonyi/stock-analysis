<div>
    <div>
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Total Stocks</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalStocks }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Top Performers</p>
                        <p class="text-2xl font-bold text-gray-800">{{ count($topPerformers) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Date Range</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $dateRange ?: 'No data' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        @if (count($topPerformers) > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Top 5 Best Performers</h2>
                    <button wire:click="clearData" onclick="return confirm('Are you sure you want to clear all data?')"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                        Clear Data
                    </button>
                </div>
                <div id="stock-chart"></div>
            </div>

            <!-- Performance Table -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Performance Details</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stock</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    First Price</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Last Price</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price Gain</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    % Gain</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($topPerformers as $performer)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $performer['stock'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${{ number_format($performer['first_price'], 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${{ number_format($performer['last_price'], 2) }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $performer['price_gain'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        ${{ number_format($performer['price_gain'], 2) }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $performer['percent_gain'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ number_format($performer['percent_gain'], 2) }}%
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No stock data available</h3>
                <p class="mt-1 text-sm text-gray-500">Upload a CSV file to see stock performance analysis.</p>
            </div>
        @endif

        @if (count($topPerformers) > 0)
            @push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                <script>
                    document.addEventListener('livewire:initialized', () => {
                        renderChart();

                        Livewire.on('stock-uploaded', () => {
                            setTimeout(() => renderChart(), 100);
                        });
                    });

                    function renderChart() {
                        const chartData = @json($chartData);

                        if (chartData.length === 0) return;

                        const options = {
                            series: chartData,
                            chart: {
                                type: 'line',
                                height: 450,
                                zoom: {
                                    enabled: true
                                },
                                toolbar: {
                                    show: true
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                curve: 'smooth',
                                width: 3
                            },
                            xaxis: {
                                type: 'datetime',
                                labels: {
                                    format: 'MMM dd'
                                }
                            },
                            yaxis: {
                                title: {
                                    text: 'Price ($)'
                                },
                                labels: {
                                    formatter: function(val) {
                                        return '$' + val.toFixed(2);
                                    }
                                }
                            },
                            legend: {
                                position: 'top',
                                horizontalAlign: 'left'
                            },
                            tooltip: {
                                x: {
                                    format: 'dd MMM yyyy'
                                },
                                y: {
                                    formatter: function(val) {
                                        return '$' + val.toFixed(2);
                                    }
                                }
                            },
                            colors: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6']
                        };

                        const chartElement = document.querySelector("#stock-chart");
                        if (chartElement) {
                            chartElement.innerHTML = '';
                            const chart = new ApexCharts(chartElement, options);
                            chart.render();
                        }
                    }
                </script>
            @endpush
        @endif
    </div>
</div>
