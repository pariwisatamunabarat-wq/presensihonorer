<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use App\Models\Leave;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_latitude',
        'schedule_longitude',
        'schedule_start_time',
        'schedule_end_time',
        'start_latitude',
        'start_longitude',
        'end_latitude',
        'end_longitude',
        'start_time',
        'end_time',
        'is_leave'
    ];

    protected $casts = [
        'is_leave' => 'boolean',
        'schedule_start_time' => 'datetime',
        'schedule_end_time' => 'datetime',
        // 'start_time' => 'datetime',
        // 'end_time' => 'datetime',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isLate()
    {
        // Gunakan timezone Asia/Makassar
        $tz = 'Asia/Makassar';
        $scheduleStartTime = Carbon::parse($this->schedule_start_time)->timezone($tz);
        $startTime = Carbon::parse($this->start_time)->timezone($tz);

        return $startTime->greaterThan($scheduleStartTime);
    }

    public function workDuration()
    {
        // Gunakan timezone Asia/Makassar
        $tz = 'Asia/Makassar';
        $startTime = Carbon::parse($this->start_time)->timezone($tz);
        $endTime = Carbon::parse($this->end_time)->timezone($tz);

        $duration = $startTime->diff($endTime);

        $hours = $duration->h;
        $minutes = $duration->i;

        return "{$hours} jam {$minutes} menit";
    }
}
