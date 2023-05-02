<?php

namespace App\Filament\Resources\ServiceResource\Widgets;

use App\Models\Job;
use App\Models\Service;
use Carbon\Carbon;
use Filament\Widgets\BarChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Auth;

class ServiceChart extends BarChartWidget
{

    protected function getHeading(): string
    {
        return 'Tickets';
    }
 
    public function getData(): array
    {
        $startDate = now()->startOfYear();
        $endDate = now()->endOfYear();

        $user = Auth::user();

        $serviceQuery = Service::query()
            ->whereBetween('created_at', [$startDate, $endDate]);
        $jobQuery = Job::query()
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($user->hasRole('User')) {
            // only display services and jobs related to the user
            $serviceQuery->where('user_id', $user->id);
            $jobQuery->where('user_id', $user->id);
        }

        $serviceCounts = $serviceQuery
            ->selectRaw('count(*) as aggregate, date(created_at) as date')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        $jobCounts = $jobQuery
            ->selectRaw('count(*) as aggregate, date(created_at) as date')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Tickets Served',
                    'data' => $jobCounts->pluck('aggregate'),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                ],
                [
                    'label' => 'Tickets',
                    'data' => $serviceCounts->pluck('aggregate'),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                ]
            ],
            'labels' => $serviceCounts->pluck('date'),
        ];
    }

    public function options(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'scales' => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true,
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }
}
