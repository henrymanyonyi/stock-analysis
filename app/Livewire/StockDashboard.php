<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\StockPrice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockDashboard extends Component
{
    public $topPerformers = [];
    public $chartData = [];
    public $totalStocks = 0;
    public $dateRange = '';

    protected $listeners = ['stock-uploaded' => 'loadData'];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $userId = Auth::id();

        // Get total unique stocks
        $this->totalStocks = StockPrice::where('user_id', $userId)
            ->distinct('stock')
            ->count('stock');

        // Get date range
        $dates = StockPrice::where('user_id', $userId)
            ->selectRaw('MIN(date) as min_date, MAX(date) as max_date')
            ->first();

        if ($dates) {
            $this->dateRange = \Carbon\Carbon::parse($dates->min_date)->format('M d, Y') . ' - ' .
                \Carbon\Carbon::parse($dates->max_date)->format('M d, Y');
        }

        // Calculate performance for each stock
        $stocks = StockPrice::where('user_id', $userId)
            ->select('stock')
            ->distinct()
            ->get();

        $performances = [];

        foreach ($stocks as $stock) {
            $prices = StockPrice::where('user_id', $userId)
                ->where('stock', $stock->stock)
                ->orderBy('date')
                ->get();

            if ($prices->count() >= 2) {
                $firstPrice = $prices->first()->price;
                $lastPrice = $prices->last()->price;
                $priceGain = $lastPrice - $firstPrice;
                $percentGain = ($firstPrice > 0) ? (($priceGain / $firstPrice) * 100) : 0;

                $performances[] = [
                    'stock' => $stock->stock,
                    'first_price' => $firstPrice,
                    'last_price' => $lastPrice,
                    'price_gain' => $priceGain,
                    'percent_gain' => $percentGain,
                    'prices' => $prices
                ];
            }
        }

        // Sort by price gain and get top 5
        usort($performances, fn($a, $b) => $b['price_gain'] <=> $a['price_gain']);
        $this->topPerformers = array_slice($performances, 0, 5);

        // Prepare chart data
        $this->prepareChartData();
    }

    protected function prepareChartData()
    {
        $series = [];

        foreach ($this->topPerformers as $performer) {
            $data = [];
            foreach ($performer['prices'] as $price) {
                $data[] = [
                    'x' => \Carbon\Carbon::parse($price->date)->timestamp * 1000,
                    'y' => floatval($price->price)
                ];
            }

            $series[] = [
                'name' => $performer['stock'],
                'data' => $data
            ];
        }

        $this->chartData = $series;
    }

    public function clearData()
    {
        StockPrice::where('user_id', Auth::id())->delete();
        $this->loadData();
        $this->dispatch('stock-uploaded');
    }

    public function render()
    {
        return view('livewire.stock-dashboard');
    }
}
