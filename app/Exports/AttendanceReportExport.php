<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AttendanceReportExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithEvents
{
    protected $attendanceData;
    protected $month;
    protected $year;
    protected $daysInMonth;

    public function __construct(Collection $attendanceData, int $month, int $year, int $daysInMonth)
    {
        $this->attendanceData = $attendanceData;
        $this->month = $month;
        $this->year = $year;
        $this->daysInMonth = $daysInMonth;
    }

    public function collection()
    {
        $rows = collect();

        foreach ($this->attendanceData as $data) {
            $row = [
                $data['no'],
                $data['user']->name,
                $data['schedule']->shift->name ?? '-',
                $data['schedule']->office->name ?? '-',
                $data['schedule']->is_wfa ? 'Ya' : 'Tidak',
                $data['schedule']->is_banned ? 'Ya' : 'Tidak',
            ];

            // Tambahkan status harian
            for ($day = 1; $day <= $this->daysInMonth; $day++) {
                $dayData = $data['daily_status'][$day] ?? ['status' => ''];
                $status = $dayData['status'];
                
                // Konversi status untuk Excel
                switch ($status) {
                    case 'H':
                        $row[] = $dayData['is_late'] ?? false ? 'H*' : 'H';
                        break;
                    case 'I':
                        $row[] = 'I';
                        break;
                    case 'A':
                        $row[] = 'A';
                        break;
                    case 'B':
                        $row[] = 'B';
                        break;
                    case '-':
                        $row[] = '-';
                        break;
                    default:
                        $row[] = '';
                }
            }

            // Tambahkan summary
            $row[] = $data['total_present'];
            $row[] = $data['total_late'];
            $row[] = $data['total_scheduled_days'];
            $row[] = $data['attendance_percentage'] . '%';

            $rows->push($row);
        }

        return $rows;
    }

    public function headings(): array
    {
        $monthNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        // Header utama
        $mainHeaders = [
            'No',
            'Nama Karyawan',
            'Shift',
            'Kantor',
            'WFA',
            'Banned',
        ];

        // Header tanggal
        for ($day = 1; $day <= $this->daysInMonth; $day++) {
            $mainHeaders[] = (string) $day;
        }

        // Header summary
        $mainHeaders[] = 'Total Hadir';
        $mainHeaders[] = 'Total Terlambat';
        $mainHeaders[] = 'Hari Kerja';
        $mainHeaders[] = 'Persentase';

        return $mainHeaders;
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = $this->getColumnLetter(6 + $this->daysInMonth + 4);
        $lastRow = $this->attendanceData->count() + 1;

        return [
            // Style header
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 11,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E3F2FD'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            // Style semua data
            "A1:{$lastColumn}{$lastRow}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            // Style kolom nama (left align)
            "B2:B{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        $widths = [
            'A' => 5,   // No
            'B' => 25,  // Nama
            'C' => 15,  // Shift
            'D' => 15,  // Kantor
            'E' => 8,   // WFA
            'F' => 8,   // Banned
        ];

        // Width untuk kolom tanggal
        $currentColumn = 'G';
        for ($day = 1; $day <= $this->daysInMonth; $day++) {
            $widths[$currentColumn] = 6;
            $currentColumn++;
        }

        // Width untuk summary columns
        $widths[$currentColumn++] = 12; // Total Hadir
        $widths[$currentColumn++] = 12; // Total Terlambat
        $widths[$currentColumn++] = 12; // Hari Kerja
        $widths[$currentColumn] = 12;   // Persentase

        return $widths;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastColumn = $this->getColumnLetter(6 + $this->daysInMonth + 4);
                $lastRow = $this->attendanceData->count() + 1;

                // Tambahkan title
                $sheet->insertNewRowBefore(1, 3);
                $sheet->mergeCells("A1:{$lastColumn}1");
                $sheet->setCellValue('A1', 'LAPORAN KEHADIRAN KARYAWAN');
                
                $sheet->mergeCells("A2:{$lastColumn}2");
                $monthName = $this->getMonthName($this->month);
                $sheet->setCellValue('A2', "{$monthName} {$this->year}");

                // Style title
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Warnai kolom weekend
                $this->colorWeekendColumns($sheet);

                // Warnai status cells
                $this->colorStatusCells($sheet);

                // Tambahkan keterangan
                // $this->addLegend($sheet, $lastRow + 2);

                // Set row height
                $sheet->getDefaultRowDimension()->setRowHeight(20);
                $sheet->getRowDimension(1)->setRowHeight(30);
                $sheet->getRowDimension(2)->setRowHeight(25);
                $sheet->getRowDimension(4)->setRowHeight(25); // Header row
            },
        ];
    }

    private function colorWeekendColumns(Worksheet $sheet)
    {
        for ($day = 1; $day <= $this->daysInMonth; $day++) {
            $currentDate = Carbon::create($this->year, $this->month, $day);
            $isWeekend = in_array($currentDate->dayOfWeek, [0, 6]); // Minggu dan Sabtu

            if ($isWeekend) {
                $columnIndex = 6 + $day; // Offset untuk kolom sebelumnya
                $columnLetter = $this->getColumnLetter($columnIndex);
                $lastRow = $this->attendanceData->count() + 4; // +4 karena ada title dan header

                $sheet->getStyle("{$columnLetter}4:{$columnLetter}{$lastRow}")->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFEBEE'], // Light red
                    ],
                ]);
            }
        }
    }

    private function colorStatusCells(Worksheet $sheet)
    {
        $rowIndex = 5; // Start from data rows (after title and headers)
        
        foreach ($this->attendanceData as $data) {
            for ($day = 1; $day <= $this->daysInMonth; $day++) {
                $dayData = $data['daily_status'][$day] ?? ['status' => ''];
                $status = $dayData['status'];
                $columnIndex = 6 + $day;
                $columnLetter = $this->getColumnLetter($columnIndex);

                $color = '';
                switch ($status) {
                    case 'H':
                        $color = $dayData['is_late'] ?? false ? 'FFF3E0' : 'E8F5E8'; // Orange for late, Green for on time
                        break;
                    case 'I':
                        $color = 'FFF9C4'; // Yellow
                        break;
                    case 'A':
                        $color = 'FFEBEE'; // Red
                        break;
                    case 'B':
                        $color = 'F5F5F5'; // Gray
                        break;
                }

                if ($color) {
                    $sheet->getStyle("{$columnLetter}{$rowIndex}")->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => $color],
                        ],
                    ]);
                }
            }
            $rowIndex++;
        }
    }

    // private function addLegend(Worksheet $sheet, int $startRow)
    // {
    //     $legendData = [
    //         ['KETERANGAN:', ''],
    //         ['H', 'Hadir'],
    //         ['H*', 'Hadir Terlambat'],
    //         ['I', 'Izin'],
    //         ['A', 'Alpha (Tidak Hadir)'],
    //         ['B', 'Diblokir'],
    //         ['-', 'Tidak Dijadwalkan'],
    //         ['', ''],
    //         ['CATATAN:', ''],
    //         ['• Kolom berwarna merah muda = Akhir pekan (Sabtu & Minggu)', ''],
    //         ['• H* = Hadir tetapi terlambat', ''],
    //         ['• Persentase dihitung dari total hari kerja yang dijadwalkan', ''],
    //     ];

    //     foreach ($legendData as $index => $legend) {
    //         $row = $startRow + $index;
    //         $sheet->setCellValue("A{$row}", $legend[0]);
    //         if (!empty($legend[1])) {
    //             $sheet->setCellValue("B{$row}", $legend[1]);
    //         }
    //     }

    //     // Style legend
    //     $sheet->getStyle("A{$startRow}:B{$startRow}")->applyFromArray([
    //         'font' => ['bold' => true, 'size' => 12],
    //     ]);

    //     $sheet->getStyle("A" . ($startRow + 8) . ":B" . ($startRow + 8))->applyFromArray([
    //         'font' => ['bold' => true, 'size' => 12],
    //     ]);
    // }

    private function getColumnLetter(int $columnIndex): string
    {
        $letter = '';
        while ($columnIndex > 0) {
            $columnIndex--;
            $letter = chr($columnIndex % 26 + 65) . $letter;
            $columnIndex = intval($columnIndex / 26);
        }
        return $letter;
    }

    // private function getDayName(int $dayOfWeek): string
    // {
    //     $dayNames = [
    //         0 => 'Min', 1 => 'Sen', 2 => 'Sel', 3 => 'Rab',
    //         4 => 'Kam', 5 => 'Jum', 6 => 'Sab'
    //     ];
    //     return $dayNames[$dayOfWeek];
    // }

    private function getMonthName(int $month): string
    {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        return $months[$month];
    }
}
