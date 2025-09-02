<?php
// app/Models/Schedule.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory;

    protected $casts = [
        'is_wfa' => 'boolean',
        'is_banned' => 'boolean',
        'allowed_days' => 'array' // Tambahkan ini
        
    ];

    protected $fillable = [
        'user_id',
        'shift_id',
        'office_id',
        'is_wfa',
        'is_banned',
        'allowed_days' // Tambahkan ini
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    // Method helper untuk mengecek apakah hari ini diizinkan
    public function isAllowedToday(): bool
    {
        if (empty($this->allowed_days)) {
            return true; // Jika tidak ada pembatasan, izinkan semua hari
        }

        // Gunakan timezone Asia/Makassar
        $today = now()->timezone('Asia/Makassar')->dayOfWeek; // 0=Minggu, 1=Senin, dst
        return in_array($today, $this->allowed_days);
    }

    // Method helper untuk mendapatkan nama hari yang diizinkan
    public function getAllowedDaysNames(): array
    {
        $dayNames = [
            0 => 'Minggu',
            1 => 'Senin', 
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu'
        ];

        if (empty($this->allowed_days)) {
            return array_values($dayNames);
        }

        return array_map(function($day) use ($dayNames) {
            return $dayNames[$day];
        }, $this->allowed_days);
    }

    // Method untuk mendapatkan informasi lengkap schedule
    public function getScheduleInfo(): string
    {
        $info = [];
        
        if ($this->shift) {
            $info[] = $this->shift->name;
            // Gunakan timezone Asia/Makassar
            $tz = 'Asia/Makassar';
            $info[] = Carbon::parse($this->shift->start_time)->timezone($tz)->format('H:i') . '-' . Carbon::parse($this->shift->end_time)->timezone($tz)->format('H:i');
        }
        
        if ($this->office) {
            $info[] = $this->office->name;
        }
        
        if ($this->is_wfa) {
            $info[] = 'WFA';
        }
        
        return implode(' | ', $info);
    }
}
