<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Leave;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentLeaves extends BaseWidget
{
    protected static ?string $heading = 'Izin Terbaru';
    protected static ?int $sort = 4;
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
        
        // Gunakan filter tanggal jika tersedia
        if (isset($this->filters['startDate']) && isset($this->filters['endDate'])) {
            $startDate = $this->filters['startDate'];
            $endDate = $this->filters['endDate'];
            
            // Konversi ke objek Carbon dengan timezone yang benar
            $start = Carbon::parse($startDate)->timezone($tz)->startOfDay();
            $end = Carbon::parse($endDate)->timezone($tz)->endOfDay();
            
            return $table
                ->query(
                    Leave::query()
                        ->where(function ($query) use ($start, $end) {
                            $query->whereBetween('start_date', [$start, $end])
                                ->orWhereBetween('end_date', [$start, $end])
                                ->orWhere(function ($q) use ($start, $end) {
                                    $q->where('start_date', '<=', $start)
                                        ->where('end_date', '>=', $end);
                                });
                        })
                        ->with('user')
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                );
        } else {
            // Jika tidak ada filter, tampilkan izin terbaru secara umum
            return $table
                ->query(
                    Leave::query()
                        ->with('user')
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                );
        }
            
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Karyawan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Tanggal Mulai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Tanggal Selesai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reason')
                    ->label('Alasan')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->paginated(false);
    }
}