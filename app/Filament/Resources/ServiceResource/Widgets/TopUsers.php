<?php

namespace App\Filament\Resources\ServiceResource\Widgets;

use App\Models\Job;
use App\Models\Service;
use Carbon\Carbon;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TopUsers extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return Job::query()
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            // ->selectRaw('count(*) as count, user_id')
            // ->with('user')
            // ->groupBy('user_id')
            // ->orderByDesc('count');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('user.name')
                ->label('Top Users'),
            // TextColumn::make('count')
            //     ->label('Jobs Count'),
        ];
    }
}
