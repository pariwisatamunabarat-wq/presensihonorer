<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? url('storage/' . $this->image) : null;
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
    
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
    
    // Method helper untuk mendapatkan schedule aktif
    public function getActiveSchedule()
    {
        return $this->schedules()->where('is_banned', false)->first();
    }
    
    // Method untuk mendapatkan kehadiran dalam periode tertentu dengan timezone Asia/Makassar
    public function getAttendancesByPeriod($startDate, $endDate)
    {
        return $this->attendances()
            ->whereBetween('start_time', [$startDate, $endDate])
            ->get();
    }
}
