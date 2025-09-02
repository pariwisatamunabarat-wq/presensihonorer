<?php

namespace App\Filament\Pages;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use App\Models\Schedule;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\Attendance;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;

class AttendanceReport extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.attendance-report';
    protected static ?string $title = 'Laporan Kehadiran';
    protected static ?string $navigationLabel = 'Laporan Kehadiran';
    protected static ?string $navigationGroup = 'Laporan';

    public ?array $data = [];
    public $selectedMonth;
    public $selectedYear;
    public $selectedUsers = [];

    public function mount(): void
    {
        // Set locale ke Indonesia
        Carbon::setLocale('id');
        // Set timezone ke Asia/Makassar
        date_default_timezone_set('Asia/Makassar');
        
        $this->selectedMonth = now()->month;
        $this->selectedYear = now()->year;
        $this->form->fill([
            'month' => $this->selectedMonth,
            'year' => $this->selectedYear,
            'users' => [],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('month')
                    ->label('Bulan')
                    ->options([
                        1 => 'Januari',
                        2 => 'Februari', 
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                        7 => 'Juli',
                        8 => 'Agustus',
                        9 => 'September',
                        10 => 'Oktober',
                        11 => 'November',
                        12 => 'Desember',
                    ])
                    ->default(now()->month)
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn ($state) => $this->selectedMonth = $state),

                Select::make('year')
                    ->label('Tahun')
                    ->options(collect(range(now()->year - 5, now()->year + 1))->mapWithKeys(fn ($year) => [$year => $year]))
                    ->default(now()->year)
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn ($state) => $this->selectedYear = $state),

                Select::make('users')
                    ->label('Pilih Karyawan')
                    ->multiple()
                    ->options(function () {
                        // Ambil semua user yang memiliki schedule
                        return User::whereHas('schedules')->pluck('name', 'id');
                    })
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(fn ($state) => $this->selectedUsers = $state ?? []),
            ])
            ->statePath('data')
            ->columns(3);
    }

    public function getAttendanceData(): Collection
    {
        if (empty($this->selectedUsers)) {
            return collect();
        }

        // Set timezone ke Asia/Makassar untuk semua operasi tanggal
        $tz = 'Asia/Makassar';
        $startDate = Carbon::create($this->selectedYear, $this->selectedMonth, 1)->startOfMonth()->timezone($tz);
        $endDate = $startDate->copy()->endOfMonth()->timezone($tz);
        $daysInMonth = $endDate->day;

        $users = User::whereIn('id', $this->selectedUsers)
            ->with(['schedules.shift', 'schedules.office'])
            ->get();
        
        $attendanceData = collect();

        foreach ($users as $index => $user) {
            // Ambil schedule user yang aktif (bukan yang banned)
            $userSchedule = $user->schedules()->where('is_banned', false)->first();
            
            if (!$userSchedule) {
                // Jika tidak ada schedule aktif, skip user ini
                continue;
            }

            // Ambil data kehadiran dengan memperhatikan timezone
            $userAttendances = Attendance::where('user_id', $user->id)
                ->whereBetween('start_time', [$startDate, $endDate])
                ->get()
                ->keyBy(function ($attendance) use ($tz) {
                    return Carbon::parse($attendance->start_time)->timezone($tz)->day;
                });

            // Ambil data cuti yang disetujui
            $userLeaves = Leave::where('user_id', $user->id)
                ->where('status', 'approved')
                ->where(function ($query) use ($startDate, $endDate, $tz) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                          ->orWhereBetween('end_date', [$startDate, $endDate])
                          ->orWhere(function ($q) use ($startDate, $endDate) {
                              $q->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                          });
                })
                ->get();

            $dailyStatus = [];
            $totalPresent = 0;
            $totalLate = 0;
            $totalScheduledDays = 0;

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $currentDate = Carbon::create($this->selectedYear, $this->selectedMonth, $day)->timezone($tz);
                $dayOfWeek = $currentDate->dayOfWeek;
                
                // Cek apakah hari ini termasuk dalam allowed_days schedule
                $isScheduledDay = $this->isScheduledDay($userSchedule, $dayOfWeek);
                
                // Cek apakah weekend (Sabtu = 6, Minggu = 0)
                $isWeekend = in_array($dayOfWeek, [0, 6]);
                
                if (!$isScheduledDay) {
                    $dailyStatus[$day] = [
                        'status' => '-',
                        'note' => $isWeekend ? 'Akhir pekan' : 'Tidak dijadwalkan',
                        'is_late' => false,
                        'is_weekend' => $isWeekend
                    ];
                    continue;
                }

                $totalScheduledDays++;

                // Check if user is on leave
                $isOnLeave = $userLeaves->contains(function ($leave) use ($currentDate) {
                    $start = Carbon::parse($leave->start_date)->startOfDay();
                    $end = Carbon::parse($leave->end_date)->endOfDay();
                    return $currentDate->between($start, $end);
                });

                if ($isOnLeave) {
                    $dailyStatus[$day] = [
                        'status' => 'I',
                        'note' => 'Izin',
                        'is_late' => false,
                        'is_weekend' => $isWeekend
                    ];
                } elseif (isset($userAttendances[$day])) {
                    $attendance = $userAttendances[$day];
                    $isLate = $this->checkIfLate($attendance, $userSchedule);
                    
                    $dailyStatus[$day] = [
                        'status' => 'H',
                        'note' => $isLate ? 'Terlambat' : 'Tepat waktu',
                        'is_late' => $isLate,
                        'start_time' => Carbon::parse($attendance->start_time)->timezone($tz)->format('H:i'),
                        'end_time' => $attendance->end_time ? Carbon::parse($attendance->end_time)->timezone($tz)->format('H:i') : null,
                        'is_weekend' => $isWeekend
                    ];
                    
                    $totalPresent++;
                    if ($isLate) {
                        $totalLate++;
                    }
                } else {
                    // Cek apakah user banned pada hari ini
                    if ($userSchedule->is_banned) {
                        $dailyStatus[$day] = [
                            'status' => 'B',
                            'note' => 'Diblokir',
                            'is_late' => false,
                            'is_weekend' => $isWeekend
                        ];
                    } else {
                        $dailyStatus[$day] = [
                            'status' => 'A',
                            'note' => 'Alpha',
                            'is_late' => false,
                            'is_weekend' => $isWeekend
                        ];
                    }
                }
            }

            $attendanceData->push([
                'no' => $index + 1,
                'user' => $user,
                'schedule' => $userSchedule,
                'daily_status' => $dailyStatus,
                'total_present' => $totalPresent,
                'total_late' => $totalLate,
                'total_scheduled_days' => $totalScheduledDays,
                'attendance_percentage' => $totalScheduledDays > 0 ? round(($totalPresent / $totalScheduledDays) * 100, 1) : 0,
                'days_in_month' => $daysInMonth,
            ]);
        }

        return $attendanceData;
    }

    private function isScheduledDay($schedule, $dayOfWeek): bool
    {
        // Jika allowed_days kosong, berarti semua hari diizinkan
        if (empty($schedule->allowed_days)) {
            return true;
        }

        return in_array($dayOfWeek, $schedule->allowed_days);
    }

    private function checkIfLate($attendance, $schedule): bool
    {
        if (!$attendance->start_time || !$schedule->shift) {
            return false;
        }
        
        // Gunakan timezone Asia/Makassar
        $tz = 'Asia/Makassar';
        
        $attendanceTime = Carbon::parse($attendance->start_time)->timezone($tz);
        $attendanceDate = $attendanceTime->format('Y-m-d');
        $scheduledTime = Carbon::parse($attendanceDate . ' ' . $schedule->shift->start_time)->timezone($tz);

        return $attendanceTime->greaterThan($scheduledTime);
    }

    public function getDaysInMonth(): int
    {
        return Carbon::create($this->selectedYear, $this->selectedMonth, 1)->daysInMonth;
    }

    public function getMonthName(): string
    {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        return $months[$this->selectedMonth] ?? '';
    }

    // Method untuk mendapatkan informasi hari dalam bahasa Indonesia
    public function getDayInfo($day): array
    {
        $tz = 'Asia/Makassar';
        $currentDate = Carbon::create($this->selectedYear, $this->selectedMonth, $day)->timezone($tz);
        $dayOfWeek = $currentDate->dayOfWeek;
        
        $dayNames = [
            0 => 'Min', // Minggu
            1 => 'Sen', // Senin
            2 => 'Sel', // Selasa
            3 => 'Rab', // Rabu
            4 => 'Kam', // Kamis
            5 => 'Jum', // Jumat
            6 => 'Sab'  // Sabtu
        ];

        $dayNamesLong = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu'
        ];

        return [
            'day_of_week' => $dayOfWeek,
            'day_name_short' => $dayNames[$dayOfWeek],
            'day_name_long' => $dayNamesLong[$dayOfWeek],
            'is_weekend' => in_array($dayOfWeek, [0, 6]), // Minggu dan Sabtu
            'formatted_date' => $currentDate->format('d/m/Y'),
            'carbon_date' => $currentDate
        ];
    }

    // Export to Excel
    public function exportToExcel()
    {
        try {
            $attendanceData = $this->getAttendanceData();
            $filename = 'Laporan_Kehadiran_' . $this->getMonthName() . '_' . $this->selectedYear . '.xlsx';

            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\AttendanceReportExport(
                    $attendanceData,
                    $this->selectedMonth,
                    $this->selectedYear,
                    $this->getDaysInMonth()
                ),
                $filename
            );
        } catch (\Exception $e) {
            Notification::make()
                ->title('Export Gagal')
                ->body('Terjadi kesalahan saat mengexport laporan: ' . $e->getMessage())
                ->danger()
                ->send();
            
            // Log error untuk debugging
            \Log::error('Export Excel Error: ' . $e->getMessage(), [
                'month' => $this->selectedMonth,
                'year' => $this->selectedYear,
                'users' => $this->selectedUsers,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    // Method untuk preview sebelum export
    public function previewExport()
    {
        if (empty($this->selectedUsers)) {
            Notification::make()
                ->title('Tidak Ada Data')
                ->body('Silakan pilih karyawan terlebih dahulu.')
                ->warning()
                ->send();
            return;
        }
        $attendanceData = $this->getAttendanceData();
        $totalRows = $attendanceData->count();
        $totalColumns = 6 + $this->getDaysInMonth() + 4; // Basic info + days + summary
        
        Notification::make()
            ->title('Preview Export')
            ->body("Siap mengexport {$totalRows} karyawan dengan {$totalColumns} kolom data untuk {$this->getMonthName()} {$this->selectedYear}")
            ->info()
            ->duration(5000)
            ->send();
    }
}
