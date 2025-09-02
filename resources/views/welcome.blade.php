<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Kehadiran Karyawan - Professional Attendance Management</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Meta Tags -->
    <meta name="description" content="Sistem Kehadiran Karyawan - Solusi manajemen presensi yang modern dan efisien">
    <meta name="keywords" content="sistem kehadiran, presensi karyawan, attendance management">
    <meta name="author" content="DewaKoding">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Styles -->
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating-animation {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .hover-scale {
            transition: transform 0.3s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="font-inter antialiased">
    <!-- Background -->
    <div class="min-h-screen gradient-bg relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-72 h-72 bg-white opacity-10 rounded-full mix-blend-multiply filter blur-xl floating-animation"></div>
            <div class="absolute top-0 right-4 w-72 h-72 bg-purple-300 opacity-10 rounded-full mix-blend-multiply filter blur-xl floating-animation" style="animation-delay: 2s;"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 opacity-10 rounded-full mix-blend-multiply filter blur-xl floating-animation" style="animation-delay: 4s;"></div>
        </div>
        
        <!-- Navigation -->
        <nav class="relative z-10 px-6 py-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-white">
                        <h1 class="text-xl font-bold">AttendanceSystem</h1>
                        <p class="text-xs opacity-80">Professional Management</p>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-6 text-white">
                    <a href="#features" class="hover:text-gray-200 transition-colors">Features</a>
                    <a href="#about" class="hover:text-gray-200 transition-colors">About</a>
                    <a href="#contact" class="hover:text-gray-200 transition-colors">Contact</a>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative z-10 flex items-center justify-center min-h-screen px-6 -mt-20">
            <div class="max-w-6xl mx-auto text-center">
                
                <!-- Main Content -->
                <div class="fade-in"><br><br>
                    <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                        Sistem Kehadiran
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-pink-400">
                            SIM-HONORER
                        </span>
                    </h1>
                    
                    <p class="text-xl md:text-2xl text-gray-200 mb-12 max-w-3xl mx-auto leading-relaxed">
                        Kelola presensi karyawan dengan mudah, efisien, dan akurat. 
                        Solusi modern untuk manajemen kehadiran yang lebih baik.
                    </p>
                </div>

                <!-- Action Cards -->
                <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-16 fade-in" style="animation-delay: 0.3s;">
                    
                    <!-- Admin Login Card -->
                    <a href="{{ url('admin/login') }}" class="group block">
                        <div class="glass-effect rounded-2xl p-8 hover-scale hover:shadow-2xl transition-all duration-300">
                            <div class="flex flex-col items-center text-center space-y-6">
                                <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Admin Dashboard</h3>
                                    <p class="text-gray-200 mb-4">
                                        Akses penuh untuk mengelola sistem kehadiran, 
                                        laporan, dan pengaturan karyawan
                                    </p>
                                    <div class="flex items-center justify-center text-blue-300 group-hover:text-blue-200 transition-colors">
                                        <span class="mr-2">Masuk sebagai Admin</span>
                                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Employee Portal Card -->
                    <a href="{{ url('admin/login') }}" class="group block">
                        <div class="glass-effect rounded-2xl p-8 hover-scale hover:shadow-2xl transition-all duration-300">
                            <div class="flex flex-col items-center text-center space-y-6">
                                <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Portal Karyawan</h3>
                                    <p class="text-gray-200 mb-4">
                                        Akses untuk karyawan melakukan presensi, 
                                        melihat riwayat, dan mengajukan izin
                                    </p>
                                    <div class="flex items-center justify-center text-green-300 group-hover:text-green-200 transition-colors">
                                        <span class="mr-2">Masuk sebagai Karyawan</span>
                                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Features Section -->
                <div id="features" class="fade-in" style="animation-delay: 0.6s;">
                    <h2 class="text-3xl font-bold text-white mb-8">Fitur Unggulan</h2>
                    <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                        
                        <div class="glass-effect rounded-xl p-6 text-center">
                            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-2">Real-time Dashboard</h3>
                            <p class="text-gray-300 text-sm">Monitor kehadiran secara real-time dengan dashboard interaktif</p>
                        </div>

                        <div class="glass-effect rounded-xl p-6 text-center">
                            <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-2">Laporan Lengkap</h3>
                            <p class="text-gray-300 text-sm">Generate laporan kehadiran dengan berbagai format export</p>
                        </div>

                        <div class="glass-effect rounded-xl p-6 text-center">
                            <div class="w-12 h-12 bg-pink-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                                                        <h3 class="text-lg font-semibold text-white mb-2">Keamanan Tinggi</h3>
                            <p class="text-gray-300 text-sm">Sistem keamanan berlapis dengan autentikasi yang aman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="relative z-10 py-16 px-6">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-4 gap-8 text-center">
                    <div class="fade-in" style="animation-delay: 0.8s;">
                        <div class="text-4xl font-bold text-white mb-2" id="counter1">0</div>
                        <div class="text-gray-300">Karyawan Aktif</div>
                    </div>
                    <div class="fade-in" style="animation-delay: 1s;">
                        <div class="text-4xl font-bold text-white mb-2" id="counter2">0</div>
                        <div class="text-gray-300">Presensi Hari Ini</div>
                    </div>
                    <div class="fade-in" style="animation-delay: 1.2s;">
                        <div class="text-4xl font-bold text-white mb-2" id="counter3">0</div>
                        <div class="text-gray-300">Tingkat Kehadiran</div>
                    </div>
                    <div class="fade-in" style="animation-delay: 1.4s;">
                        <div class="text-4xl font-bold text-white mb-2" id="counter4">0</div>
                        <div class="text-gray-300">Departemen</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div id="about" class="relative z-10 py-20 px-6">
            <div class="max-w-4xl mx-auto text-center">
                <div class="fade-in">
                    <h2 class="text-4xl font-bold text-white mb-8">Tentang Sistem Kami</h2>
                    <p class="text-xl text-gray-200 mb-12 leading-relaxed">
                        Sistem Kehadiran Karyawan adalah solusi modern yang dirancang untuk memudahkan 
                        pengelolaan presensi dengan teknologi terdepan. Kami mengutamakan kemudahan, 
                        keakuratan, dan efisiensi dalam setiap fitur yang disediakan.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="fade-in" style="animation-delay: 0.3s;">
                        <div class="glass-effect rounded-2xl p-8">
                            <h3 class="text-2xl font-bold text-white mb-6">Mengapa Memilih Kami?</h3>
                            <div class="space-y-4 text-left">
                                <div class="flex items-start space-x-3">
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-semibold">Interface User-Friendly</h4>
                                        <p class="text-gray-300 text-sm">Desain yang intuitif dan mudah digunakan</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-3">
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-semibold">Real-time Monitoring</h4>
                                        <p class="text-gray-300 text-sm">Pantau kehadiran secara langsung</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-3">
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-semibold">Laporan Komprehensif</h4>
                                        <p class="text-gray-300 text-sm">Analisis mendalam dengan visualisasi data</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-3">
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-semibold">Multi-platform Support</h4>
                                        <p class="text-gray-300 text-sm">Akses dari berbagai perangkat</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fade-in" style="animation-delay: 0.6s;">
                        <div class="glass-effect rounded-2xl p-8">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-4">Teknologi Modern</h3>
                            <p class="text-gray-300 leading-relaxed">
                                Dibangun dengan teknologi terkini menggunakan Laravel dan Filament, 
                                memberikan performa optimal dan pengalaman pengguna yang luar biasa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="relative z-10 py-20 px-6">
            <div class="max-w-4xl mx-auto text-center">
                <div class="glass-effect rounded-3xl p-12 fade-in">
                    <h2 class="text-4xl font-bold text-white mb-6">
                        Siap Memulai?
                    </h2>
                    <p class="text-xl text-gray-200 mb-8">
                        Bergabunglah dengan ribuan perusahaan yang telah mempercayai sistem kami
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ url('admin/login') }}" 
                           class="inline-flex items-center px-8 py-4 bg-white text-gray-900 font-semibold rounded-xl hover:bg-gray-100 transition-colors shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Mulai Sekarang
                        </a>
                        <a href="#contact" 
                           class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-gray-900 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer id="contact" class="relative z-10 py-12 px-6 border-t border-white/10">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="text-white">
                                <h3 class="text-xl font-bold">AttendanceSystem</h3>
                                <p class="text-sm opacity-80">Professional Management</p>
                            </div>
                        </div>
                        <p class="text-gray-300 mb-4 max-w-md">
                            Solusi terdepan untuk manajemen kehadiran karyawan dengan teknologi modern dan interface yang user-friendly.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                                        <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-white font-semibold mb-4">Fitur Utama</h4>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="#" class="hover:text-white transition-colors">Dashboard Real-time</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Manajemen Karyawan</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Laporan Kehadiran</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Pengaturan Shift</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-white font-semibold mb-4">Kontak</h4>
                        <div class="space-y-2 text-gray-300">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>info@dewakoding.com</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>+62 123 456 789</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                </svg>
                                <span>DINAS PARIWISATA DAN EKONOMI KREATIF MUNA BARAT</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-white/10 mt-12 pt-8 text-center">
                    <p class="text-gray-300">
                        © {{ date('Y') }} AttendanceSystem. Dikembangkan dengan ❤️ oleh 
                        <a href="#" class="text-white hover:text-gray-200 transition-colors font-semibold">M.A.R</a>
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript -->
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Counter animation
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            const timer = setInterval(() => {
                start += increment;
                if (start >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(start);
                }
            }, 16);
        }

        // Intersection Observer for counter animation
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = [
                        { element: document.getElementById('counter1'), target: 150 },
                        { element: document.getElementById('counter2'), target: 89 },
                        { element: document.getElementById('counter3'), target: 95 },
                        { element: document.getElementById('counter4'), target: 12 }
                    ];

                    counters.forEach((counter, index) => {
                        setTimeout(() => {
                            if (counter.target === 95) {
                                // For percentage
                                animateCounter(counter.element, counter.target);
                                setTimeout(() => {
                                    counter.element.textContent = counter.target + '%';
                                }, 2000);
                            } else {
                                animateCounter(counter.element, counter.target);
                            }
                        }, index * 200);
                    });

                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe the stats section
        const statsSection = document.querySelector('#counter1').closest('div').parentElement;
        observer.observe(statsSection);

        // Parallax effect for background elements
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.floating-animation');
            
            parallaxElements.forEach((element, index) => {
                const speed = 0.5 + (index * 0.1);
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // Add loading animation
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
        });

        // Mobile menu toggle (if needed)
        const mobileMenuButton = document.querySelector('[data-mobile-menu]');
        const mobileMenu = document.querySelector('[data-mobile-menu-content]');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Add scroll effect to navigation
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 100) {
                nav.classList.add('backdrop-blur-md', 'bg-white/10');
            } else {
                nav.classList.remove('backdrop-blur-md', 'bg-white/10');
            }
        });

        // Add typing effect to main title (optional)
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            element.innerHTML = '';
            
            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            
            type();
        }

        // Initialize typing effect after page load
        setTimeout(() => {
            const titleElement = document.querySelector('h1');
            if (titleElement) {
                const originalText = titleElement.textContent;
                typeWriter(titleElement, originalText, 50);
            }
        }, 1000);

        // Add hover effects for cards
        document.querySelectorAll('.hover-scale').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05) translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) translateY(0)';
            });
        });

        // Add click ripple effect
        function createRipple(event) {
            const button = event.currentTarget;
            const circle = document.createElement('span');
            const diameter = Math.max(button.clientWidth, button.clientHeight);
            const radius = diameter / 2;

            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
            circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
            circle.classList.add('ripple');

            const ripple = button.getElementsByClassName('ripple')[0];
            if (ripple) {
                ripple.remove();
            }

            button.appendChild(circle);
        }

        // Add ripple effect to buttons
        document.querySelectorAll('a[href*="admin/login"]').forEach(button => {
            button.addEventListener('click', createRipple);
        });

        // Add CSS for ripple effect
        const style = document.createElement('style');
        style.textContent = `
            .ripple {
                position: absolute;
                border-radius: 50%;
                background-color: rgba(255, 255, 255, 0.3);
                transform: scale(0);
                animation: ripple-animation 0.6s linear;
                pointer-events: none;
            }

            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>