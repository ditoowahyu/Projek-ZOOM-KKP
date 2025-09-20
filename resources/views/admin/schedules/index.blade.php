<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Jadwal Zoom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 6px 20px rgba(0,0,0,0.1);
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
        table th, table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">📅 Admin Panel</a>
        <div class="d-flex">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-custom">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4 text-center" data-aos="fade-down">Kelola Jadwal Zoom</h2>

    <!-- Form tambah jadwal -->
    <div class="card mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card-header bg-primary text-white fw-bold">Tambah Jadwal Baru</div>
        <div class="card-body">
            <form action="{{ route('admin.schedules.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Judul Meeting</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Meeting ID</label>
                        <input type="text" name="meeting_id" class="form-control" required>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Password (opsional)</label>
                        <input type="text" name="password" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal & Waktu</label>
                        <input type="datetime-local" name="schedule_time" class="form-control" required>
                    </div>
                </div>
                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-success btn-custom">✅ Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar jadwal -->
    <div class="card" data-aos="fade-up" data-aos-delay="200">
        <div class="card-header bg-secondary text-white fw-bold">Daftar Jadwal</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Meeting ID</th>
                            <th>Password</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($schedules as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $schedule->title }}</td>
                                <td>{{ $schedule->meeting_id }}</td>
                                <td>{{ $schedule->password ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->schedule_time)->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.schedules.edit', $schedule->id) }}" 
                                       class="btn btn-warning btn-sm btn-custom">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-custom">🗑️ Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">📌 Belum ada jadwal</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap & AOS -->
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
