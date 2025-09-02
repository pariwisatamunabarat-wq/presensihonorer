<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="p-2 bg-primary-100 rounded-full">
                    <x-heroicon-o-clock class="w-6 h-6 text-primary-600" />
                </div>
                
                <div>
                    <h3 id="current-time" class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ now()->timezone('Asia/Makassar')->format('H:i:s') }}
                    </h3>
                    <p id="current-date" class="text-sm text-gray-500 dark:text-gray-400">
                        {{ now()->timezone('Asia/Makassar')->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    </p>
                </div>
            </div>
            
            <div class="text-right">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    Asia/Makassar
                </span>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk memperbarui waktu
        function updateTime() {
            // Buat objek Date baru
            const now = new Date();
            
            // Format waktu: HH:MM:SS
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;
            
            // Format tanggal dalam bahasa Indonesia
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            
            const dayName = days[now.getDay()];
            const date = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();
            
            const dateString = `${dayName}, ${date} ${monthName} ${year}`;
            
            // Update elemen DOM
            const timeElement = document.getElementById('current-time');
            const dateElement = document.getElementById('current-date');
            
            if (timeElement) {
                timeElement.textContent = timeString;
            }
            
            if (dateElement) {
                dateElement.textContent = dateString;
            }
        }
        
        // Pastikan elemen ada sebelum memulai interval
        if (document.getElementById('current-time') && document.getElementById('current-date')) {
            // Update waktu setiap detik
            setInterval(updateTime, 1000);
            
            // Update waktu pertama kali
            updateTime();
        }
    });
</script>