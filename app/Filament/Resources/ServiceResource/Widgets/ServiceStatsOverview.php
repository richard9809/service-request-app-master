<?php

namespace App\Filament\Resources\ServiceResource\Widgets;

use App\Models\Department;
use App\Models\Job;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;

class ServiceStatsOverview extends BaseWidget
{
    
    protected function getCards(): array
    {
        $user = auth()->user();
        
        $currentMonth = now()->format('m');
        $previousMonth = now()->subMonth()->format('m');

        $query = DB::table('services')
            ->select(DB::raw('COUNT(*) as count'))
            ->whereNotExists(function ($query) use ($currentMonth){
                $query->select(DB::raw(1))
                    ->from('jobs')
                    ->whereRaw('jobs.service_id = services.id')
                    ->whereMonth('jobs.created_at', $currentMonth);
            });
        
        if(!$user->hasRole(['System Admin', 'Admin']))
        {
            // If user is not an admin, add a where clause to filter tickets by the user id
            $query->where('services.user_id', $user->id);
        }

        $result = $query->first();
        $count = $result->count;

        $jobCount = auth()->user()->hasRole(['Admin', 'System Admin'])
                ? Job::count()
                : Job::where('user_id', auth()->id())->count();

        return [
            Card::make('Tickets', $count),
            Card::make('Jobs', $jobCount),
            Card::make('Total Number of Ministries', Department::all()->count()),
        ];
    }
}
