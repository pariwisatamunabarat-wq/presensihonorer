<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class AccountWidget extends Widget
{
    protected static string $view = 'filament.widgets.account-widget';
    
    protected int | string | array $columnSpan = 'full';
    
    protected static bool $isLazy = false;
    
    protected static string $permission = 'widget_account_widget';
    
    public static function canView(): bool
    {
        // Tampilkan widget untuk semua user yang login
        return Auth::check();
    }
    
    public function getViewData(): array
    {
        $user = Auth::user();
        
        return [
            'user' => $user,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->image ? url('storage/' . $user->image) : null,
            'role' => $user->getRoleNames()->first() ?? 'User',
        ];
    }
}