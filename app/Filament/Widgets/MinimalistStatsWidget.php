<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MinimalistStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        $user = Auth::user();
        
        // Check if user is super_admin
        if ($user->hasRole('super_admin') || $user->role === 'super_admin') {
            return $this->getSuperAdminStats();
        } else {
            return $this->getEmployeeStats();
        }
    }

    private function getSuperAdminStats(): array
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        
        // Today's stats
        $presentToday = Attendance::whereDate('start_time', $today)->count();
        $presentYesterday = Attendance::whereDate('start_time', $yesterday)->count();
        $presentChange = $presentYesterday > 0 ? 
            round((($presentToday - $presentYesterday) / $presentYesterday) * 100, 1) : 0;

        // Late stats
        $lateToday = Attendance::whereDate('start_time', $today)
            ->get()
            ->filter(function ($attendance) {
                return $this->isLate($attendance);
            })->count();

        // Leave stats
        $onLeaveToday = Leave::where('status', 'approved')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->count();

        // Pending leaves
        $pendingLeaves = Leave::where('status', 'pending')->count();

        // Total employees
        $totalEmployees = User::whereHas('schedules')->count();

        return [
            Stat::make('Total Karyawan', $totalEmployees)
                ->description('Karyawan aktif dengan jadwal')
                ->descriptionIcon('heroicon-m-users')
                ->color('info')
                ->chart([12, 15, 18, 20, 22, 25, $totalEmployees])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-indigo-50 to-indigo-100 border-indigo-200',
                ]),

            Stat::make('Hadir Hari Ini', $presentToday)
                ->description($presentChange >= 0 ? "+{$presentChange}% dari kemarin" : "{$presentChange}% dari kemarin")
                ->descriptionIcon($presentChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($presentChange >= 0 ? 'success' : 'danger')
                ->chart([7, 3, 4, 5, 6, 3, 5, $presentToday])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-blue-50 to-blue-100 border-blue-200',
                ]),
                
            Stat::make('Terlambat', $lateToday)
                ->description('Karyawan terlambat hari ini')
                ->descriptionIcon('heroicon-m-clock')
                ->color($lateToday > 5 ? 'danger' : ($lateToday > 2 ? 'warning' : 'success'))
                ->chart([2, 1, 3, 2, 4, 1, $lateToday])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-orange-50 to-orange-100 border-orange-200',
                ]),
                
            Stat::make('Izin Pending', $pendingLeaves)
                ->description('Menunggu persetujuan')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($pendingLeaves > 0 ? 'warning' : 'success')
                ->chart([1, 2, 0, 1, 3, 2, $pendingLeaves])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-red-50 to-red-100 border-red-200',
                ]),
        ];
    }

    private function getEmployeeStats(): array
    {
        $user = Auth::user();
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Employee's attendance today
        $attendanceToday = Attendance::where('user_id', $user->id)
            ->whereDate('start_time', $today)
            ->first();

        // Employee's monthly attendance
        $monthlyAttendance = Attendance::where('user_id', $user->id)
            ->whereBetween('start_time', [$startOfMonth, $endOfMonth])
            ->count();

        // Employee's late count this month
        $monthlyLate = Attendance::where('user_id', $user->id)
            ->whereBetween('start_time', [$startOfMonth, $endOfMonth])
            ->get()
            ->filter(function ($attendance) {
                return $this->isLate($attendance);
            })->count();

        // Employee's leave calculation - FIXED
        $approvedLeaves = Leave::where('user_id', $user->id)
            ->where('status', 'approved')
            ->whereYear('created_at', now()->year)
            ->get();

        // Calculate total leave days used
        $usedLeaves = $approvedLeaves->sum(function ($leave) {
            $startDate = Carbon::parse($leave->start_date);
            $endDate = Carbon::parse($leave->end_date);
            return $startDate->diffInDays($endDate) + 1; // +1 to include both start and end date
        });

        $leaveBalance = max(0, 12 - $usedLeaves); // Assuming 12 days annual leave, minimum 0

        // Employee's pending leave requests
        $pendingLeaves = Leave::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        // Working days in current month
        $workingDays = $this->getWorkingDaysInMonth();
        $attendanceRate = $workingDays > 0 ? round(($monthlyAttendance / $workingDays) * 100, 1) : 0;

        // Get user schedule for expected check-in time
        $schedule = $user->schedules->first();
        $expectedCheckIn = $schedule && $schedule->shift ? $schedule->shift->start_time : '08:00:00';

        // Helper function to safely format time
        $formatTime = function($time) {
            if (is_string($time)) {
                return Carbon::parse($time)->format('H:i');
            } elseif ($time instanceof Carbon) {
                return $time->format('H:i');
            } else {
                return 'N/A';
            }
        };

        return [
            Stat::make('Status Hari Ini', $attendanceToday ? 'Sudah Absen' : 'Belum Absen')
                ->description($attendanceToday ? 
                    ($this->isLate($attendanceToday) ? 
                        'Terlambat - Masuk: ' . $formatTime($attendanceToday->start_time) : 
                        'Tepat Waktu - Masuk: ' . $formatTime($attendanceToday->start_time)
                    ) : 
                    'Jadwal masuk: ' . $formatTime($expectedCheckIn)
                )
                ->descriptionIcon($attendanceToday ? 
                    ($this->isLate($attendanceToday) ? 'heroicon-m-exclamation-triangle' : 'heroicon-m-check-circle') : 
                    'heroicon-m-clock'
                )
                ->color($attendanceToday ? 
                    ($this->isLate($attendanceToday) ? 'warning' : 'success') : 
                    'gray'
                )
                ->extraAttributes([
                    'class' => $attendanceToday ? 
                        ($this->isLate($attendanceToday) ? 
                            'bg-gradient-to-br from-orange-50 to-orange-100 border-orange-200' : 
                            'bg-gradient-to-br from-green-50 to-green-100 border-green-200'
                        ) : 
                        'bg-gradient-to-br from-gray-50 to-gray-100 border-gray-200',
                ]),

            Stat::make('Kehadiran Bulan Ini', $monthlyAttendance . ' Hari')
                ->description("Tingkat kehadiran: {$attendanceRate}% dari {$workingDays} hari kerja")
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color($attendanceRate >= 90 ? 'success' : ($attendanceRate >= 75 ? 'warning' : 'danger'))
                ->chart($this->getMonthlyAttendanceChart())
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-blue-50 to-blue-100 border-blue-200',
                ]),

            Stat::make('Keterlambatan', $monthlyLate . ' Kali')
                ->description($monthlyLate > 3 ? 'Perlu diperbaiki' : ($monthlyLate > 0 ? 'Cukup baik' : 'Sangat baik'))
                ->descriptionIcon('heroicon-m-clock')
                ->color($monthlyLate > 3 ? 'danger' : ($monthlyLate > 0 ? 'warning' : 'success'))
                ->chart($this->getMonthlyLateChart())
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-orange-50 to-orange-100 border-orange-200',
                ]),

            Stat::make('Sisa Cuti', $leaveBalance . ' Hari')
                ->description($pendingLeaves > 0 ? 
                    "{$pendingLeaves} pengajuan pending | Terpakai: {$usedLeaves} hari" : 
                    "Terpakai: {$usedLeaves} dari 12 hari"
                )
                ->descriptionIcon('heroicon-m-calendar')
                ->color($leaveBalance > 6 ? 'success' : ($leaveBalance > 3 ? 'warning' : 'danger'))
                ->chart($this->getLeaveChart($usedLeaves, $leaveBalance))
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-green-50 to-green-100 border-green-200',
                ]),
        ];
    }

    private function isLate($attendance): bool
    {
        if (!$attendance) return false;
        
        $schedule = $attendance->user->schedules->first();
        if (!$schedule || !$schedule->shift) return false;
        
        // Safely parse the start_time
        $attendanceTime = is_string($attendance->start_time) ? 
            Carbon::parse($attendance->start_time) : 
            $attendance->start_time;
            
        $scheduledTime = Carbon::parse($attendanceTime->format('Y-m-d') . ' ' . $schedule->shift->start_time);
        return $attendanceTime->greaterThan($scheduledTime);
    }

    private function getWorkingDaysInMonth(): int
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $today = Carbon::today();
        $workingDays = 0;

        for ($date = $startOfMonth->copy(); $date->lte($today); $date->addDay()) {
            // Skip weekends (Saturday = 6, Sunday = 0)
            if (!in_array($date->dayOfWeek, [0, 6])) {
                $workingDays++;
            }
        }

        return $workingDays;
    }

    private function getMonthlyAttendanceChart(): array
    {
        $user = Auth::user();
        $data = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $count = Attendance::where('user_id', $user->id)
                ->whereDate('start_time', $date)
                ->count();
            $data[] = $count;
        }
        
        return $data;
    }

    private function getMonthlyLateChart(): array
    {
        $user = Auth::user();
        $data = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $attendance = Attendance::where('user_id', $user->id)
                ->whereDate('start_time', $date)
                ->first();
            
            $data[] = ($attendance && $this->isLate($attendance)) ? 1 : 0;
        }
        
        return $data;
    }

    private function getLeaveChart($usedLeaves, $leaveBalance): array
    {
        // Simple chart showing used vs remaining leave days
        return [$usedLeaves, $leaveBalance, 0, 0, 0, 0, 0];
    }

    // Override canView method to control widget visibility
    public static function canView(): bool
    {
        return Auth::check();
    }
}