<?php

namespace App\Filament\Pages;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use App\Models\Attendance;
use App\Filament\Widgets\AccountWidget;
use App\Filament\Widgets\ServerTimeWidget;
use App\Filament\Widgets\AttendanceStatsOverview;
use App\Filament\Widgets\AttendanceChart;
use App\Filament\Widgets\RecentAttendances;
use App\Filament\Widgets\RecentLeaves;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        // Hanya tampilkan filter form untuk super_admin
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return $form->schema([]);
        }
        
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        DatePicker::make('startDate')
                            ->label('Tanggal Mulai')
                            ->maxDate(fn (Get $get) => $get('endDate') ?: now())
                            ->default(now()->startOfMonth())
                            ->live(),
                        DatePicker::make('endDate')
                            ->label('Tanggal Akhir')
                            ->minDate(fn (Get $get) => $get('startDate') ?: now())
                            ->maxDate(now())
                            ->default(now())
                            ->live(),
                        Select::make('period')
                            ->label('Periode Cepat')
                            ->options([
                                'today' => 'Hari Ini',
                                'week' => 'Minggu Ini',
                                'month' => 'Bulan Ini',
                                'year' => 'Tahun Ini',
                            ])
                            ->live()
                            ->afterStateUpdated(function ($state, $set) {
                                $dates = match($state) {
                                    'today' => [now()->startOfDay(), now()->endOfDay()],
                                    'week' => [now()->startOfWeek(), now()->endOfWeek()],
                                    'month' => [now()->startOfMonth(), now()->endOfMonth()],
                                    'year' => [now()->startOfYear(), now()->endOfYear()],
                                    default => [now()->startOfMonth(), now()->endOfMonth()],
                                };
                                
                                $set('startDate', $dates[0]);
                                $set('endDate', $dates[1]);
                            }),
                    ])
                    ->columns(3),
            ]);
    }

    public function getHeaderWidgets(): array
    {
        $user = Auth::user();
        $widgets = [];
        
        // Tampilkan AccountWidget untuk semua user
        $widgets[] = AccountWidget::class;
        
        // Hanya tampilkan ServerTimeWidget untuk super_admin
        if ($user && $user->hasRole('super_admin')) {
            $widgets[] = ServerTimeWidget::class;
        }
        
        // Hanya tampilkan AttendanceStatsOverview untuk super_admin
        if ($user && $user->hasRole('super_admin')) {
            $widgets[] = AttendanceStatsOverview::class;
        }
        
        return $widgets;
    }

    public function getWidgets(): array
    {
        $user = Auth::user();
        $widgets = [];
        
        // Hanya tampilkan widget berikut untuk super_admin
        if ($user && $user->hasRole('super_admin')) {
            $widgets = [
                AttendanceChart::class,
                RecentAttendances::class,
                RecentLeaves::class,
            ];
        }
        
        return $widgets;
    }
    
    public function getWidgetData(): array
    {
        return [
            'filters' => $this->filters,
        ];
    }
}