<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentAttendances extends BaseWidget
{
    protected static ?string $heading = 'Kehadiran Terbaru';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    
    public ?array $filters = [];

    public function mount(?array $filters = null): void
    {
        $this->filters = $filters ?? [];
    }

    public function table(Table $table): Table
    {
        // Set timezone
        $tz = 'Asia/Makassar';
        
        // Gunakan filter tanggal jika tersedia, jika tidak gunakan default (hari ini)
        $startDate = $this->filters['startDate'] ?? now()->timezone($tz)->startOfDay();
        $endDate = $this->filters['endDate'] ?? now()->timezone($tz)->endOfDay();
        
        // Konversi ke objek Carbon dengan timezone yang benar
        $start = Carbon::parse($startDate)->timezone($tz)->startOfDay();
        $end = Carbon::parse($endDate)->timezone($tz)->endOfDay();

        return $table
            ->query(
                Attendance::query()
                    ->whereBetween('start_time', [$start, $end])
                    ->with('user')
                    ->orderBy('start_time', 'desc')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Karyawan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Waktu Masuk')
                    ->dateTime('H:i:s')
                    ->timezone($tz)
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->label('Waktu Keluar')
                    ->dateTime('H:i:s')
                    ->timezone($tz)
                    ->placeholder('-'),
                Tables\Columns\TextColumn::make('lateStatus')
                    ->label('Status')
                    ->formatStateUsing(function ($state, $record) {
                        return $record->isLate() ? 'Terlambat' : 'Tepat Waktu';
                    })
                    ->color(function ($state, $record) {
                        return $record->isLate() ? 'warning' : 'success';
                    })
                    ->badge(),
            ])
            ->paginated(false);
    }
}