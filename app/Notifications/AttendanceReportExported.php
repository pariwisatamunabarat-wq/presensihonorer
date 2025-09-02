<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AttendanceReportExported extends Notification implements ShouldQueue
{
    use Queueable;

    protected $filename;
    protected $month;
    protected $year;
    protected $totalUsers;

    public function __construct($filename, $month, $year, $totalUsers)
    {
        $this->filename = $filename;
        $this->month = $month;
        $this->year = $year;
        $this->totalUsers = $totalUsers;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $monthNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return (new MailMessage)
                    ->subject('Laporan Kehadiran Berhasil Diexport')
                    ->greeting('Halo!')
                    ->line("Laporan kehadiran untuk {$monthNames[$this->month]} {$this->year} telah berhasil diexport.")
                    ->line("Total karyawan: {$this->totalUsers}")
                    ->line("File: {$this->filename}")
                    ->action('Lihat Dashboard', url('/admin'))
                    ->line('Terima kasih telah menggunakan sistem kami!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Laporan kehadiran berhasil diexport",
            'filename' => $this->filename,
            'month' => $this->month,
            'year' => $this->year,
            'total_users' => $this->totalUsers,
        ];
    }
}
