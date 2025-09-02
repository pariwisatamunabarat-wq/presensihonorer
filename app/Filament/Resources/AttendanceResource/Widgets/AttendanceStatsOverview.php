<?php

namespace App\Filament\Resources\AttendanceResource\Widgets;

use App\Models\Attendance;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = Auth::user()->id;
        $isSuperAdmin = Auth::user()->hasRole('super_admin');
        
        // Query builder base
        $query = Attendance::query();
        
        if (!$isSuperAdmin) {
            $query->where('user_id', $userId);
        }
        
        // Get current month data
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        $monthlyQuery = clone $query;
        $monthlyAttendances = $monthlyQuery
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();
        
        // Calculate statistics
        $totalHadir = $monthlyAttendances->count();
        
        $totalTerlambat = $monthlyAttendances->filter(function ($attendance) {
            return $attendance->isLate();
        })->count();
        
        $totalTepatWaktu = $totalHadir - $totalTerlambat;
        
        // Calculate average work duration
        $totalMinutes = 0;
        $attendanceWithEndTime = $monthlyAttendances->filter(function ($attendance) {
            return $attendance->end_time !== null;
        });
        
        foreach ($attendanceWithEndTime as $attendance) {
            $startTime = Carbon::parse($attendance->start_time);
            $endTime = Carbon::parse($attendance->end_time);
            $totalMinutes += $startTime->diffInMinutes($endTime);
        }
        
        $averageMinutes = $attendanceWithEndTime->count() > 0 
            ? round($totalMinutes / $attendanceWithEndTime->count()) 
            : 0;
        
        $averageHours = floor($averageMinutes / 60);
        $averageRemainingMinutes = $averageMinutes % 60;
        $averageDuration = "{$averageHours} jam {$averageRemainingMinutes} menit";
        
        // Calculate percentage
        $persentaseKehadiran = $totalHadir > 0 
            ? round(($totalTepatWaktu / $totalHadir) * 100, 1) 
            : 0;
        
        // Get previous month data for comparison
        $previousMonth = Carbon::now()->subMonth();
        $previousMonthQuery = clone $query;
        $previousMonthTotal = $previousMonthQuery
            ->whereMonth('created_at', $previousMonth->month)
            ->whereYear('created_at', $previousMonth->year)
            ->count();
        
        // Calculate trend
        $trendHadir = $previousMonthTotal > 0 
            ? round((($totalHadir - $previousMonthTotal) / $previousMonthTotal) * 100, 1)
            : 0;
        
        return [
            Stat::make('Total Kehadiran Bulan Ini', $totalHadir)
                ->description($trendHadir >= 0 
                    ? "{$trendHadir}% peningkatan dari bulan lalu" 
                    : abs($trendHadir) . "% penurunan dari bulan lalu")
                ->descriptionIcon($trendHadir >= 0 
                    ? 'heroicon-m-arrow-trending-up' 
                    : 'heroicon-m-arrow-trending-down')
                ->color($trendHadir >= 0 ? 'success' : 'danger')
                ->chart($this->getMonthlyChart($query))
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:ring-2 hover:ring-primary-500 transition'
                ]),
            
            Stat::make('Tepat Waktu', $totalTepatWaktu)
                ->description("Persentase: {$persentaseKehadiran}%")
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart($this->getWeeklyChart($query, false))
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:ring-2 hover:ring-success-500 transition'
                ]),
            
            Stat::make('Terlambat', $totalTerlambat)
                ->description($totalHadir > 0 
                    ? 'Dari total ' . $totalHadir . ' kehadiran'
                    : 'Tidak ada data')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger')
                ->chart($this->getWeeklyChart($query, true))
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:ring-2 hover:ring-danger-500 transition'
                ]),
            
            Stat::make('Rata-rata Durasi Kerja', $averageDuration)
                ->description('Per hari kerja')
                ->descriptionIcon('heroicon-m-clock')
                ->color('info')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:ring-2 hover:ring-info-500 transition'
                ]),
        ];
    }
    
    /**
     * Get monthly attendance chart data
     */
    protected function getMonthlyChart($query): array
    {
        $data = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = (clone $query)
                ->whereDate('created_at', $date)
                ->count();
            $data[] = $count;
        }
        
        return $data;
    }
    
    /**
     * Get weekly late/on-time chart data
     */
    protected function getWeeklyChart($query, bool $isLate = false): array
    {
        $data = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $attendances = (clone $query)
                ->whereDate('created_at', $date)
                ->get();
            
            if ($isLate) {
                $count = $attendances->filter(function ($attendance) {
                    return $attendance->isLate();
                })->count();
            } else {
                $count = $attendances->filter(function ($attendance) {
                    return !$attendance->isLate();
                })->count();
            }
            
            $data[] = $count;
        }
        
        return $data;
    }
    
    /**
     * Set polling interval for real-time updates
     */
    protected static ?string $pollingInterval = '30s';
}
