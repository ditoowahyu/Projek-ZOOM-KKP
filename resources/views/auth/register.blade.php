<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kepolisian - Registrasi</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)),
                url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect fill="%23f0f4ff" width="100" height="100"/><path d="M0,0 L100,100 M100,0 L0,100" stroke="%23dbeafe" stroke-width="1"/></svg>');
        }

        .security-feature {
            transition: all 0.3s ease;
        }

        .security-feature:hover {
            transform: translateY(-3px);
        }

        .btn-register {
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(13, 71, 161, 0.2);
        }

        .maluku-pattern {
            background: linear-gradient(45deg, #0d47a1 0%, #1e88e5 50%, #0d47a1 100%);
            position: relative;
            overflow: hidden;
        }

        .maluku-pattern::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60"><path d="M0,0 L60,60 M60,0 L0,60" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></svg>');
            background-size: 40px 40px;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="container max-w-6xl w-full mx-auto rounded-xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

        <!-- Bagian Kiri (Keterangan) -->
        <div class="w-full md:w-2/5 maluku-pattern text-white p-8 md:p-10 flex flex-col justify-center relative">
            <div class="mb-8 text-center relative z-10">
                <!-- Logo -->
                <div class="mb-4 flex justify-center">
                    <img src="{{ asset('TIK_POLRI.png') }}" alt="Logo Polda Maluku" class="h-24">
                </div>
                <h2 class="text-xl font-semibold">KEPOLISIAN DAERAH MALUKU</h2>
                <div class="w-20 h-1 bg-white mx-auto my-4 rounded-full"></div>
                <p class="text-sm opacity-90 mt-4">Bergabunglah dengan sistem informasi terpadu untuk mendukung pelayanan dan operasional kepolisian di wilayah Maluku</p>
            </div>

            <div class="space-y-4 mt-6 relative z-10">
                <div class="security-feature flex items-center bg-white bg-opacity-10 p-3 rounded-lg">
                    <div class="bg-white bg-opacity-20 p-2 rounded-full mr-3">
                        <i class="fas fa-id-card text-xl"></i>
                    </div>
                    <div>
                        <p class="font-semibold">Verifikasi Identitas</p>
                        <p class="text-sm opacity-80">Proses verifikasi ketat untuk keamanan sistem</p>
                    </div>
                </div>

               

                <div class="security-feature flex items-center bg-white bg-opacity-10 p-3 rounded-lg">
                    <div class="bg-white bg-opacity-20 p-2 rounded-full mr-3">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="font-semibold">Kolaborasi Tim</p>
                        <p class="text-sm opacity-80">Kerja sama yang efisien antar unit kepolisian</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Kanan (Form Registrasi) -->
        <div class="w-full md:w-3/5 bg-white p-8 md:p-10 flex flex-col justify-center">
            <!-- Logo di atas "REGISTRASI SISTEM" -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('TIK_POLRI.png') }}" alt="Logo Sistem" class="h-20">
            </div>

            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">REGISTRASI SISTEM</h2>
                <p class="text-gray-600 mt-2">Isi data diri Anda untuk membuat akun baru</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4 animate__animated animate__fadeIn">
                @csrf

                <!-- Nama -->
                <div class="animate__animated animate__fadeIn animate__fast">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input id="name" type="text" name="name" 
                            class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                            placeholder="Masukkan nama lengkap" required autofocus>
                    </div>
                </div>

                <!-- Email -->
                <div class="animate__animated animate__fadeIn animate__fast">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" type="email" name="email"
                            class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                            placeholder="Masukkan email" required>
                    </div>
                </div>

                <!-- Password -->
                <div class="animate__animated animate__fadeIn animate__fast">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" type="password" name="password"
                            class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                            placeholder="Buat kata sandi" required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" id="togglePassword"
                                class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="animate__animated animate__fadeIn animate__fast">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                            placeholder="Konfirmasi kata sandi" required>
                    </div>
                </div>

                <!-- Tombol Daftar -->
                <div class="animate__animated animate__fadeInUp">
                    <button type="submit"
                        class="btn-register w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-3 px-4 rounded-lg shadow-md transition duration-300">
                        Daftar
                    </button>
                </div>
            </form>

            <!-- Tautan ke Login -->
            <div class="mt-6 text-center animate__animated animate__fadeInUp">
                <span>Sudah punya akun? </span>
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    Login di sini
                </a>
            </div>
        </div>
    </div>

    <script>
        // Script untuk toggle show/hide password
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });

        // Animasi untuk elemen form
        document.addEventListener('DOMContentLoaded', function() {
            const formElements = document.querySelectorAll('input, button, a');
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(10px)';
                element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';

                setTimeout(() => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, 100 + (index * 100));
            });
        });
    </script>
</body>

</html>