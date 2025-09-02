@php
    $user = Auth::user();
@endphp

<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            <x-filament-panels::avatar.user size="lg" :user="$user" />
            
            <div class="flex-1">
                <h2 class="text-lg font-bold text-gray-950 dark:text-white">
                    {{ __('Selamat datang, :name', ['name' => $user->name]) }}
                </h2>
                
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $user->email }}
                </p>
                
                <div class="mt-2 flex flex-wrap gap-2">
                    @foreach ($user->roles as $role)
                        <x-filament::badge color="primary">
                            {{ $role->name }}
                        </x-filament::badge>
                    @endforeach
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>