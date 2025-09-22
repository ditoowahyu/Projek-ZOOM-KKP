<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Jadwal Zoom</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        h2 {
            font-weight: bold;
            color: #343a40;
        }

        .btn-custom {
            border-radius: 25px;
            padding: 8px 20px;
        }

        table th,
        table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>

    @include('admin.nafbar_admin')

    <div class="container mt-5">

        <!-- Judul Halaman -->
        <h2 class="mb-4 text-center fw-bold text-primary fs-1" data-aos="fade-down">
            Kelola Jadwal Zoom
        </h2>
        <div class="mb-3 text-end">
            <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">
                ➕ Tambah Jadwal Zoom
            </a>
        </div>


        <!-- Daftar Jadwal -->
        <div class="card" data-aos="fade-up" data-aos-delay="200">
            <div class="card-header bg-secondary text-white fw-bold">
                Daftar Jadwal
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Meeting ID</th>
                                <th>Password</th>
                                <th>Waktu</th>
                                <th>Perwira</th>
                                <th>petugas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schedules as $schedule)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $schedule->title }}</td>
                                    <td>{{ $schedule->meeting_id }}</td>
                                    <td>{{ $schedule->password ?? '-' }}</td>
                                    <td>{{ $schedule->schedule_time->format('d M Y H:i') }}</td>
                                    <td>{{ $schedule->perwira?->nama ?? '-' }}</td>
                                    <td>{{ $schedule->anggota?->name ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.schedules.edit', $schedule->id) }}"
                                            class="btn btn-warning btn-sm btn-custom">✏️ Edit</a>
                                        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-custom">🗑️
                                                Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">📌 Belum ada jadwal</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        @if (method_exists($schedules, 'links'))
                            {{ $schedules->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS & AOS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>

</body>

</html>
