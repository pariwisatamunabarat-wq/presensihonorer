<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Filter Form -->
        <x-filament::section>
            <x-slot name="heading">
                Filter Laporan
            </x-slot>
            
            {{ $this->form }}
            
            <div class="mt-4 flex flex-wrap gap-3">
                <x-filament::button 
                    wire:click="$refresh"
                    color="primary"
                    icon="heroicon-o-magnifying-glass"
                >
                    Tampilkan Laporan
                </x-filament::button>

                @if(!empty($this->selectedUsers))
                    
                    <x-filament::button 
                        wire:click="exportToExcel"
                        color="success"
                        icon="heroicon-o-document-arrow-down"
                        outlined
                    >
                        Export Excel
                    </x-filament::button>

                    
                @endif
            </div>
        </x-filament::section>

        <!-- Report Table -->
        @if(!empty($this->selectedUsers))
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex justify-between items-center">
                    <span>Laporan Kehadiran - {{ $this->getMonthName() }} {{ $this->selectedYear }}</span>
                </div>
            </x-slot>

            <div class="overflow-x-auto">
                <div class="min-w-full">
                    <table class="w-full border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr>
                                <th rowspan="3" class="border border-gray-300 bg-blue-100 px-2 py-3 text-center font-semibold">No</th>
                                <th rowspan="3" class="border border-gray-300 bg-blue-100 px-4 py-3 text-left font-semibold min-w-[150px]">Nama</th>
                                <th rowspan="3" class="border border-gray-300 bg-purple-100 px-2 py-3 text-center font-semibold min-w-[100px]">Shift</th>
                                <th colspan="{{ $this->getDaysInMonth() }}" class="border border-gray-300 bg-green-100 px-2 py-2 text-center font-semibold">
                                    {{ $this->getMonthName() }} {{ $this->selectedYear }}
                                </th>
                                <th rowspan="3" class="border border-gray-300 bg-yellow-100 px-2 py-3 text-center font-semibold">Hadir</th>
                                <th rowspan="3" class="border border-gray-300 bg-orange-100 px-2 py-3 text-center font-semibold">Terlambat</th>
                                <th rowspan="3" class="border border-gray-300 bg-cyan-100 px-2 py-3 text-center font-semibold">Persentase</th>
                                <th rowspan="3" class="border border-gray-300 bg-red-100 px-2 py-3 text-center font-semibold">Keterangan</th>
                            </tr>
                            <!-- Row untuk hari dalam bahasa Indonesia -->
                            <tr>
                                @for($day = 1; $day <= $this->getDaysInMonth(); $day++)
                                                                        @php
                                        $dayInfo = $this->getDayInfo($day);
                                    @endphp
                                    <th class="border border-gray-300 px-1 py-1 text-center text-xs w-8
                                        @if($dayInfo['is_weekend']) bg-red-100 text-red-700 font-bold
                                        @else bg-green-50 text-gray-700
                                        @endif
                                    " title="{{ $dayInfo['day_name_long'] }}, {{ $dayInfo['formatted_date'] }}">
                                        {{ $dayInfo['day_name_short'] }}
                                    </th>
                                @endfor
                            </tr>
                            <!-- Row untuk tanggal -->
                            <tr>
                                @for($day = 1; $day <= $this->getDaysInMonth(); $day++)
                                    @php
                                        $dayInfo = $this->getDayInfo($day);
                                    @endphp
                                    <th class="border border-gray-300 px-1 py-2 text-center text-xs w-8 font-bold
                                        @if($dayInfo['is_weekend']) bg-red-200 text-red-800
                                        @else bg-green-50 text-gray-800
                                        @endif
                                    " title="{{ $dayInfo['day_name_long'] }}, {{ $dayInfo['formatted_date'] }}">
                                        {{ $day }}
                                    </th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($this->getAttendanceData() as $data)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-2 py-2 text-center">{{ $data['no'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-left font-medium">
                                        {{ $data['user']->name }}
                                        @if($data['schedule']->is_wfa)
                                            <span class="inline-block ml-1 px-1 py-0.5 text-xs bg-blue-100 text-blue-800 rounded">WFA</span>
                                        @endif
                                        @if($data['schedule']->is_banned)
                                            <span class="inline-block ml-1 px-1 py-0.5 text-xs bg-red-100 text-red-800 rounded">BANNED</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-2 py-2 text-center text-xs">
                                        <div class="font-medium">{{ $data['schedule']->shift->name ?? '-' }}</div>
                                        @if($data['schedule']->shift)
                                            <div class="text-gray-500">
                                                {{ \Carbon\Carbon::parse($data['schedule']->shift->start_time)->timezone('Asia/Makassar')->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($data['schedule']->shift->end_time)->timezone('Asia/Makassar')->format('H:i') }}
                                            </div>
                                        @endif
                                        @if($data['schedule']->office)
                                            <div class="text-gray-500 mt-1">{{ $data['schedule']->office->name }}</div>
                                        @endif
                                    </td>
                                    
                                    @for($day = 1; $day <= $this->getDaysInMonth(); $day++)
                                        @php
                                            $dayData = $data['daily_status'][$day] ?? ['status' => '', 'note' => '', 'is_late' => false, 'is_weekend' => false];
                                            $status = $dayData['status'];
                                            $isLate = $dayData['is_late'] ?? false;
                                            $isWeekend = $dayData['is_weekend'] ?? false;
                                            $dayInfo = $this->getDayInfo($day);
                                        @endphp
                                        <td class="border border-gray-300 px-1 py-2 text-center text-xs relative group
                                            @if($isWeekend && $status === '-') bg-red-50 text-red-400
                                            @elseif($status === 'H' && $isLate) bg-orange-100 text-orange-800 font-bold
                                            @elseif($status === 'H') bg-green-100 text-green-800 font-bold
                                            @elseif($status === 'I') bg-yellow-100 text-yellow-800 font-bold
                                            @elseif($status === 'A') bg-red-100 text-red-800 font-bold
                                            @elseif($status === 'B') bg-gray-100 text-gray-800 font-bold
                                            @elseif($status === '-') bg-gray-50 text-gray-400
                                            @endif
                                            @if($isWeekend) border-red-300
                                            @endif
                                        " title="{{ $dayData['note'] ?? '' }} - {{ $dayInfo['day_name_long'] }}, {{ $dayInfo['formatted_date'] }}">
                                            {{ $status }}
                                            @if($status === 'H' && isset($dayData['start_time']))
                                                <!-- Tooltip untuk jam masuk/keluar -->
                                                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-10 whitespace-nowrap">
                                                    <div class="font-semibold">{{ $dayInfo['day_name_long'] }}, {{ $day }} {{ $this->getMonthName() }}</div>
                                                    <div>Masuk: {{ $dayData['start_time'] }}</div>
                                                    @if(isset($dayData['end_time']))
                                                        <div>Keluar: {{ $dayData['end_time'] }}</div>
                                                    @endif
                                                    @if($isLate)
                                                        <div class="text-orange-300 font-semibold">⚠️ Terlambat</div>
                                                    @endif
                                                    @if($isWeekend)
                                                        <div class="text-red-300">📅 Akhir Pekan</div>
                                                    @endif
                                                </div>
                                            @elseif($status !== '' && $status !== '-')
                                                <!-- Tooltip untuk status lainnya -->
                                                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-10 whitespace-nowrap">
                                                    <div class="font-semibold">{{ $dayInfo['day_name_long'] }}, {{ $day }} {{ $this->getMonthName() }}</div>
                                                    <div>{{ $dayData['note'] ?? '' }}</div>
                                                    @if($isWeekend)
                                                        <div class="text-red-300">📅 Akhir Pekan</div>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                    @endfor
                                    
                                    <td class="border border-gray-300 px-2 py-2 text-center font-semibold">
                                        {{ $data['total_present'] }}/{{ $data['total_scheduled_days'] }}
                                    </td>
                                    <td class="border border-gray-300 px-2 py-2 text-center font-semibold text-orange-600">
                                        {{ $data['total_late'] }}
                                    </td>
                                    <td class="border border-gray-300 px-2 py-2 text-center font-semibold
                                        @if($data['attendance_percentage'] >= 90) text-green-600
                                        @elseif($data['attendance_percentage'] >= 75) text-yellow-600
                                        @else text-red-600
                                        @endif
                                    ">
                                        {{ $data['attendance_percentage'] }}%
                                    </td>
                                    <td class="border border-gray-300 px-2 py-2 text-center text-xs">
                                        <div>{{ $data['total_present'] }} dari {{ $data['total_scheduled_days'] }} hari kerja</div>
                                        @if($data['total_late'] > 0)
                                            <div class="text-orange-600 mt-1">{{ $data['total_late'] }}x terlambat</div>
                                        @endif
                                        @if($data['schedule']->is_wfa)
                                            <div class="text-blue-600 mt-1">Work From Anywhere</div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ 8 + $this->getDaysInMonth() }}" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                                        Pilih karyawan untuk menampilkan data kehadiran
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Calendar Legend -->
            <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                <h5 class="font-semibold text-blue-900 mb-2">📅 Kalender {{ $this->getMonthName() }} {{ $this->selectedYear }}</h5>
                <div class="grid grid-cols-7 gap-1 text-xs">
                    @for($day = 1; $day <= $this->getDaysInMonth(); $day++)
                        @php
                            $dayInfo = $this->getDayInfo($day);
                        @endphp
                        <div class="text-center p-1 rounded
                            @if($dayInfo['is_weekend']) bg-red-100 text-red-700 font-bold
                            @else bg-white text-gray-700
                            @endif
                        " title="{{ $dayInfo['day_name_long'] }}, {{ $dayInfo['formatted_date'] }}">
                            <div class="font-semibold">{{ $day }}</div>
                            <div class="text-xs">{{ $dayInfo['day_name_short'] }}</div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Summary Statistics -->
            @if($this->getAttendanceData()->isNotEmpty())
                <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                    @php
                        $totalEmployees = $this->getAttendanceData()->count();
                        $avgAttendance = $this->getAttendanceData()->avg('attendance_percentage');
                        $totalLateInstances = $this->getAttendanceData()->sum('total_late');
                        $perfectAttendance = $this->getAttendanceData()->where('attendance_percentage', 100)->count();
                    @endphp
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="text-blue-600 text-sm font-medium">👥 Total Karyawan</div>
                        <div class="text-2xl font-bold text-blue-900">{{ $totalEmployees }}</div>
                    </div>
                    
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="text-green-600 text-sm font-medium">📊 Rata-rata Kehadiran</div>
                        <div class="text-2xl font-bold text-green-900">{{ number_format($avgAttendance, 1) }}%</div>
                    </div>
                    
                    <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                        <div class="text-orange-600 text-sm font-medium">⏰ Total Keterlambatan</div>
                        <div class="text-2xl font-bold text-orange-900">{{ $totalLateInstances }}</div>
                    </div>
                    
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <div class="text-purple-600 text-sm font-medium">🏆 Kehadiran Sempurna</div>
                        <div class="text-2xl font-bold text-purple-900">{{ $perfectAttendance }}</div>
                    </div>
                </div>
            @endif

            <!-- Legend -->
            <div class="mt-6 rounded-lg bg-gray-50 p-4">
                <h4 class="font-semibold text-gray-900 mb-3">📋 Keterangan Status:</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 text-sm">
                    <div class="flex items-center space-x-2">
                        <span class="inline-block w-6 h-6 bg-green-100 border border-green-300 rounded text-center text-xs font-semibold text-green-800">H</span>
                        <span>Hadir</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-block w-6 h-6 bg-orange-100 border border-orange-300 rounded text-center text-xs font-semibold text-orange-800">H</span>
                        <span>Hadir Terlambat</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-block w-6 h-6 bg-yellow-100 border border-yellow-300 rounded text-center text-xs font-semibold text-yellow-800">I</span>
                        <span>Izin</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-block w-6 h-6 bg-red-100 border border-red-300 rounded text-center text-xs font-semibold text-red-800">A</span>
                        <span>Alpha</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-block w-6 h-6 bg-gray-100 border border-gray-300 rounded text-center text-xs font-semibold text-gray-800">B</span>
                        <span>Diblokir</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-block w-6 h-6 bg-gray-50 border border-gray-300 rounded text-center text-xs font-semibold text-gray-400">-</span>
                        <span>Tidak Dijadwalkan</span>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-t border-gray-200">
                                        <h5 class="font-medium text-gray-900 mb-2">ℹ️ Informasi Tambahan:</h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-gray-600">
                        <div>• 🔴 <strong>Kolom merah</strong> = Akhir pekan (Sabtu & Minggu)</div>
                        <div>• 🖱️ Hover pada status untuk detail jam kerja</div>
                        <div>• 📊 Persentase dihitung dari hari kerja yang dijadwalkan</div>
                        <div>• 🏠 WFA = Work From Anywhere</div>
                        <div>• 🚫 Status "Banned" = User yang diblokir</div>
                        <div>• 📅 Format tanggal: DD/MM/YYYY</div>
                    </div>
                </div>

                <!-- Weekend Days Info -->
                <div class="mt-4 pt-3 border-t border-gray-200">
                    <h5 class="font-medium text-gray-900 mb-2">📅 Hari Libur (Akhir Pekan) - {{ $this->getMonthName() }} {{ $this->selectedYear }}:</h5>
                    <div class="flex flex-wrap gap-2 text-sm">
                        @for($day = 1; $day <= $this->getDaysInMonth(); $day++)
                            @php
                                $dayInfo = $this->getDayInfo($day);
                            @endphp
                            @if($dayInfo['is_weekend'])
                                <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">
                                    {{ $dayInfo['day_name_long'] }}, {{ $day }} {{ $this->getMonthName() }}
                                </span>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </x-filament::section>
        @endif
    </div>

    <!-- Loading overlay untuk export -->
    <div wire:loading.flex wire:target="exportToExcel,exportToPdf" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
            <svg class="animate-spin h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-gray-700 font-medium">Sedang mengexport laporan...</span>
        </div>
    </div>

    <style>
        .table-container {
            overflow-x: auto;
            max-width: 100%;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 1400px;
        }
        
        th, td {
            border: 1px solid #d1d5db;
            white-space: nowrap;
        }
        
        .name-column {
            min-width: 150px;
        }
        
        .day-column {
            width: 30px;
        }

        /* Weekend styling */
        .weekend-header {
            background-color: #fee2e2 !important;
            color: #dc2626 !important;
            font-weight: bold;
        }

        .weekend-cell {
            border-color: #fca5a5 !important;
        }

        /* Tooltip styling */
        .group:hover .group-hover\:opacity-100 {
            opacity: 1;
        }

        /* Enhanced weekend styling */
        th.bg-red-100, th.bg-red-200 {
            position: relative;
        }

        th.bg-red-100::before, th.bg-red-200::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 40%, rgba(239, 68, 68, 0.1) 50%, transparent 60%);
            pointer-events: none;
        }

        /* Calendar mini view styling */
        .calendar-mini .weekend {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 1px solid #f87171;
        }
    </style>

    <!-- Additional JavaScript for enhanced interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Highlight weekend columns on hover
            const weekendHeaders = document.querySelectorAll('th.bg-red-100, th.bg-red-200');
            const weekendCells = document.querySelectorAll('td.border-red-300');
            
            weekendHeaders.forEach((header, index) => {
                header.addEventListener('mouseenter', function() {
                    // Add highlight class to corresponding column
                    const columnIndex = Array.from(header.parentNode.children).indexOf(header);
                    const rows = document.querySelectorAll('tbody tr');
                    rows.forEach(row => {
                        const cell = row.children[columnIndex];
                        if (cell) {
                            cell.classList.add('bg-red-50');
                        }
                    });
                });
                
                header.addEventListener('mouseleave', function() {
                    // Remove highlight class
                    const columnIndex = Array.from(header.parentNode.children).indexOf(header);
                    const rows = document.querySelectorAll('tbody tr');
                    rows.forEach(row => {
                        const cell = row.children[columnIndex];
                        if (cell) {
                            cell.classList.remove('bg-red-50');
                        }
                    });
                });
            });

            // Add click handler for weekend info
            weekendHeaders.forEach(header => {
                header.style.cursor = 'help';
                header.title = 'Akhir pekan - Klik untuk info lebih lanjut';
            });
        });
    </script>
</x-filament-panels::page>