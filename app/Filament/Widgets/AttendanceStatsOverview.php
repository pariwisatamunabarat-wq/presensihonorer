<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use App\Models\Attendance;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AttendanceStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    
    public ?array $filters = [];

    public function mount(?array $filters = null): void
    {
        $this->filters = $filters ?? [];
    }

    protected function getStats(): array
    {
        // Set timezone
        $tz = 'Asia/Makassar';
        
        // Gunakan filter tanggal jika tersedia, jika tidak gunakan default
        $startDate = $this->filters['startDate'] ?? now()->timezone($tz)->startOfMonth();
        $endDate = $this->filters['endDate'] ?? now()->timezone($tz);
        
        // Konversi ke objek Carbon dengan timezone yang benar
        $start = Carbon::parse($startDate)->timezone($tz)->startOfDay();
        $end = Carbon::parse($endDate)->timezone($tz)->endOfDay();

        // Total karyawan
        $totalEmployees = User::whereHas('schedules')->count();

        // Kehadiran dalam periode filter
        $periodAttendances = Attendance::whereBetween('start_time', [$start, $end])->count();

        // Izin dalam periode filter
        $periodLeaves = Leave::where('status', 'approved')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhere(function ($q) use ($start, $end) {
                        $q->where('start_date', '<=', $start)
                            ->where('end_date', '>=', $end);
                    });
            })
            ->count();

        // Karyawan terlambat dalam periode filter
        $lateAttendances = Attendance::whereBetween('start_time', [$start, $end])
            ->get()
            ->filter(function ($attendance) {
                return $attendance->isLate();
            })
            ->count();

        // Persentase kehadiran
        $attendancePercentage = $totalEmployees > 0 ? round(($periodAttendances / $totalEmployees) * 100, 1) : 0;

        return [
            Stat::make('Total Karyawan', $totalEmployees)
                ->description('Karyawan aktif')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
            
            Stat::make('Kehadiran Periode', $periodAttendances)
                ->description('Presensi dalam periode')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('success'),
            
            Stat::make('Persentase Kehadiran', $attendancePercentage . '%')
                ->description('Dari total karyawan')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),
            
            Stat::make('Izin Disetujui', $periodLeaves)
                ->description('Dalam periode filter')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),
            
            Stat::make('Terlambat', $lateAttendances)
                ->description('Dalam periode filter')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger'),
        ];
    }
}