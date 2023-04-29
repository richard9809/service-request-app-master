<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;

class UserStatsOverview extends BaseWidget
{
    public static function canView(): bool
    {
        return auth()->user()->hasRole(['System Admin' ,'Admin']);
    }

    protected function getCards(): array
    {

        // Count the number of users with role_id = 1 (System Administrators)
        $sysAdminCount = DB::table('model_has_roles')
        ->where('role_id', '=', 1)
        ->count();

        // Count the number of users with role_id = 2 (Administrators)
        $adminCount = DB::table('model_has_roles')
        ->where('role_id', '=', 2)
        ->count();

        // Count the number of users with role_id = 3 (ICT Officers)
        $ictOfficerCount = DB::table('model_has_roles')
        ->where('role_id', '=', 3)
        ->count();

        return [
            Card::make('All Users', User::all()->count()),
            Card::make('System Administrators',  $sysAdminCount),
            Card::make('Administrators', $adminCount),
            Card::make('ICT Officers', $ictOfficerCount),
        ];
    }
}
