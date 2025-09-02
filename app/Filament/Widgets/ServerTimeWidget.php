<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class ServerTimeWidget extends Widget
{
    protected static string $view = 'filament.widgets.server-time-widget';
    
    protected int | string | array $columnSpan = 'full';
    
    protected static bool $isLazy = false;
    
    protected static string $permission = 'widget_server_time_widget';
    
    public static function canView(): bool
    {
        // Hanya tampilkan widget untuk super admin
        $user = Auth::user();
        return $user && $user->hasRole('super_admin');
    }
    
    public function getViewData(): array
    {
        // Double check dalam getViewData juga
        $user = Auth::user();
        
        // Jika bukan super admin, return empty array
        if (!$user || !$user->hasRole('super_admin')) {
            return [];
        }
        
        // Set timezone ke Asia/Makassar
        $tz = 'Asia/Makassar';
        $now = now()->timezone($tz);
        
        return [
            'date' => $now->format('l, d F Y'),
            'time' => $now->format('H:i:s'),
            'timezone' => $tz,
        ];
    }
}