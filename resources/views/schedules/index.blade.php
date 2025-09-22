{{-- resources/views/schedules/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jadwal Zoom</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<body>

    @include('schedules.navbar')


    <!-- Content -->
    <div class="container my-4">
        <div class="card shadow animate__animated animate__fadeInUp">
            <div class="card-header">
                <h5 class="mb-0 text-warning">📅 Daftar Jadwal Zoom</h5>
            </div>

            <div class="card-body animate__animated animate__zoomIn">
                <!-- Tambahin responsive wrapper -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Judul</th>
                                <th>Meeting ID</th>
                                <th>Password</th>
                                <th>Waktu</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schedules as $schedule)
                                <tr class="animate__animated animate__fadeInUp">
                                    <td>{{ $schedule->title }}</td>
                                    <td>{{ $schedule->meeting_id }}</td>
                                    <td>{{ $schedule->password ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->schedule_time)->format('d M Y H:i') }}</td>
                                    <td class="text-center">
                                        <a href="https://zoom.us/j/{{ $schedule->meeting_id }}?pwd={{ $schedule->password }}"
                                            target="_blank" class="btn btn-sm btn-warning text-dark fw-semibold w-100">
                                            Join
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada jadwal tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white text-center py-3 mt-5 animate__animated animate__fadeInUp">
        <small>© 2025 POLDA Maluku - Sistem Informasi Jadwal Zoom</small>
    </footer>

    <!-- Modal Profil -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">Edit Profil</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ Auth::user()->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru (opsional)</label>
                            <input type="password" id="password" name="password" class="form-control">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
