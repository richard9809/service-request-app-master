<?php

namespace App\Filament\Resources\ServiceResource\Widgets;

use App\Models\Service;
use Carbon\Carbon;
use Filament\Widgets\DoughnutChartWidget;
use Illuminate\Support\Facades\Auth;

class FaultsChart extends DoughnutChartWidget
{
    protected function getHeading(): string
    {
        return 'Category Per Month';
    }

    public function getData(): array
    {
        $query = Service::query();

        if(Auth::user()->hasRole('User')) {
            $query->where('user_id', Auth::id());
        }
        
        $data = $query->select('fault')
            ->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth(),
            ])
            ->get()
            ->groupBy('fault')
            ->map(fn ($item) => $item->count());

        return [
            'datasets' => [
                [
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => [
                        '#f44336',
                        '#3f51b5',
                        '#009688',
                    ],
                ],
            ],
            'labels' => [
                'Hardware/Software/Technical',
                'Network/Wireless',
                'Other:Please Specify',
            ]
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'week' => 'Last 7 Days',
            'month' => 'Last 30 Days',
            'year' => 'This Year',
        ];
    }
}
