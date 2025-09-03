<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use App\Models\User;

use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Set;

class Map extends Component implements HasForms
{
    use InteractsWithForms;
    public $markers = [];

    public $total_price;

    public $created_at = '';

    public function mount(): void
    {
        $this->form->fill([
            'created_at' => now()->toDateString(), // Set default ke hari ini
        ]);
        $this->filterAttendance();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Filter')
                    ->schema([
                        Forms\Components\DatePicker::make('created_at')
                            ->label('Date')
                            // ->default(now()->toDateString())
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                $this->created_at = $state;
                                $this->filterAttendance();
                            }),

                    ]),
            ]);
    }

    public function render()
    {
        return view('livewire.map');
    }

    public function filterAttendance()
    {
        $query = Attendance::with('user');

        // Jika tanggal dipilih, filter berdasarkan tanggal tersebut
        if (!empty($this->created_at)) {
            $query->whereDate('created_at', $this->created_at);
        } else {
            // Jika tidak ada tanggal yang dipilih, tampilkan presensi hari ini
            $query->whereDate('created_at', now()->toDateString());
        }

        $this->markers = $query->get();
        $this->dispatch('markersUpdated');
    }


}
