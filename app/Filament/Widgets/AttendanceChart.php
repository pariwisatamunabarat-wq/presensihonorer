<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\User;
use Filament\Widgets\ChartWidget;

class AttendanceChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Kehadiran';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    
    public ?array $filters = [];

    public function mount(?array $filters = null): void
    {
        $this->filters = $filters ?? [];
    }

    protected function getData(): array
    {
        // Set timezone
        $tz = 'Asia/Makassar';
        
        // Gunakan filter tanggal jika tersedia
        $startDate = $this->filters['startDate'] ?? now()->timezone($tz)->startOfMonth();
        $endDate = $this->filters['endDate'] ?? now()->timezone($tz);
        
        // Konversi ke objek Carbon dengan timezone yang benar
        $start = Carbon::parse($startDate)->timezone($tz)->startOfDay();
        $end = Carbon::parse($endDate)->timezone($tz)->endOfDay();
        
        // Hitung jumlah hari antara start dan end date
        $daysDiff = $start->diffInDays($end);
        
        // Batasi maksimal 30 hari untuk mencegah overload
        $maxDays = min($daysDiff + 1, 30);
        
        // Inisialisasi array data
        $dates = [];
        $attendanceData = [];
        $lateData = [];
        $onTimeData = [];
        
        // Hitung total karyawan dengan schedule
        $totalEmployees = User::whereHas('schedules')->count();
        
        // Loop untuk setiap hari dalam periode
        for ($i = 0; $i < $maxDays; $i++) {
            $currentDate = $start->copy()->addDays($i);
            $dates[] = $currentDate->format('d M');
            
            // Hitung kehadiran pada tanggal ini
            $startOfDay = $currentDate->startOfDay();
            $endOfDay = $currentDate->endOfDay();
            
            $attendances = Attendance::whereBetween('start_time', [$startOfDay, $endOfDay])->get();
            $attendanceCount = $attendances->count();
            $attendanceData[] = $attendanceCount;
            
            // Hitung terlambat dan tepat waktu
            $lateCount = $attendances->filter(function ($attendance) {
                return $attendance->isLate();
            })->count();
            
            $onTimeCount = $attendanceCount - $lateCount;
            $lateData[] = $lateCount;
            $onTimeData[] = $onTimeCount;
        }
        
        return [
            'labels' => $dates,
            'datasets' => [
                [
                    'label' => 'Tepat Waktu',
                    'data' => $onTimeData,
                    'backgroundColor' => '#10B981',
                    'borderColor' => '#059669',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Terlambat',
                    'data' => $lateData,
                    'backgroundColor' => '#F59E0B',
                    'borderColor' => '#D97706',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}