<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLDA Maluku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 70px;
            /* Memberi ruang untuk navbar fixed */
        }

        .navbar-custom,
        footer {
            background: linear-gradient(135deg, #3a3a3a 0%, #2c2c2c 100%);
            padding: 0.5rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar-custom .navbar-brand {
            color: #ffcc00;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .navbar-custom .nav-link,
        .navbar-custom .btn-outline-light {
            color: #fff;
            transition: all 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: #ffcc00;
        }

        .navbar-custom .btn-outline-light:hover {
            background-color: #ffcc00;
            color: #3a3a3a !important;
            border-color: #ffcc00;
        }

        .profile-img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
            border: 2px solid #ffcc00;
        }

        .brand-logo {
            height: 40px;
            margin-right: 10px;
        }

        .nav-item {
            margin: 0 5px;
        }

        .nav-button {
            padding: 0.4rem 0.8rem;
            font-size: 0.9rem;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-button i {
            margin-right: 5px;
        }

        .dropdown-menu {
            background-color: #3a3a3a;
            border: 1px solid #ffcc00;
        }

        .dropdown-item {
            color: #fff;
        }

        .dropdown-item:hover {
            background-color: #ffcc00;
            color: #3a3a3a;
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: linear-gradient(135deg, #3a3a3a 0%, #2c2c2c 100%);
                padding: 15px;
                border-radius: 5px;
                margin-top: 10px;
                border: 1px solid #ffcc00;
            }

            .nav-item {
                margin: 5px 0;
            }

            .navbar-toggler {
                border: 1px solid rgba(255, 204, 0, 0.5);
                padding: 0.25rem 0.5rem;
            }

            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 204, 0, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }

            .dropdown-menu {
                background-color: #2c2c2c;
                margin-top: 5px;
            }
        }

        /* Animasi untuk navbar */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar-custom .dropdown-menu {
            animation: slideIn 0.3s ease;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <!-- Menggunakan placeholder logo jika gambar tidak tersedia -->
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/polda-logo.png') }}" alt="Logo Polda Maluku" class="brand-logo">
                    POLDA Maluku
                </a>
            </a>

            <!-- Toggle untuk mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-lg-center">

                    <!-- Tombol Laporan Zoom -->
                    <li class="nav-item">
                        <a href="{{ route('user.schedules') }}" class="btn btn-sm btn-warning nav-button ms-lg-2">
                            <i class="fas fa-video"></i> Laporan Zoom
                        </a>
                    </li>
                    <!-- Tombol Laporan -->
                    <li class="nav-item">
                        <a href="{{ route('reports.index') }}" class="btn btn-sm btn-warning nav-button">
                            <i class="fas fa-file-alt"></i> Laporan
                        </a>
                    </li>

                    

                    <!-- Profil user -->
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name=User+Name&background=ffcc00&color=3a3a3a"
                                alt="Profile" class="profile-img">
                            <span class="d-none d-lg-inline">
                                {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                            </span>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Pengaturan</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="nav-item mt-2 mt-lg-0 ms-lg-3">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-light w-100 w-lg-auto">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                    <!-- Tombol Logout (visible hanya di mobile) -->
                    <li class="nav-item d-lg-none mt-2">
                        <a href="#logout" class="btn btn-sm btn-outline-light w-100">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Script untuk menangani navbar
        document.addEventListener('DOMContentLoaded', function() {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');

            // Menutup navbar ketika item di klik (untuk mobile)
            const navLinks = document.querySelectorAll('.nav-link, .nav-button');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        navbarCollapse.classList.remove('show');
                    }
                });
            });

            // Handler untuk dropdown
            const dropdownToggle = document.querySelector('.dropdown-toggle');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            dropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);
                dropdownMenu.classList.toggle('show');
            });

            // Menutup dropdown ketika klik di luar
            document.addEventListener('click', function(e) {
                if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownToggle.setAttribute('aria-expanded', 'false');
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>
</body>

</html>
