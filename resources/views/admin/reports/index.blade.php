<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan Zoom</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom responsive cards for small screens */
        @media (max-width: 768px) {
            table {
                display: none;
            }
            .report-card {
                display: block !important;
                margin-bottom: 1rem;
            }
        }
        @media (min-width: 769px) {
            .report-card {
                display: none;
            }
        }
    </style>
</head>
<body>
    @include('admin.nafbar_admin')

    <div class="container my-5">
        <h1 class="mb-4 text-center">Data Laporan Zoom</h1>

        <!-- Alert -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Table for large screens -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->user->name ?? 'Tidak ada' }}</td>
                            <td>{{ $report->title }}</td>
                            <td>{{ Str::limit($report->description, 50) }}</td>
                            <td>
                                @if($report->image)
                                    <img src="{{ asset('storage/'.$report->image) }}" alt="Gambar" class="img-thumbnail" width="100">
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada laporan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Cards for mobile -->
        @forelse($reports as $report)
            <div class="card report-card shadow-sm mb-3 p-3">
                <h5 class="card-title">{{ $report->title }}</h5>
                <p class="mb-1"><strong>User:</strong> {{ $report->user->name ?? 'Tidak ada' }}</p>
                <p class="mb-1"><strong>Deskripsi:</strong> {{ $report->description }}</p>
                @if($report->image)
                    <img src="{{ asset('storage/'.$report->image) }}" alt="Gambar" class="img-fluid my-2">
                @endif
                <p class="mb-2"><strong>Tanggal:</strong> {{ $report->created_at->format('d-m-Y H:i') }}</p>
                <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                </form>
            </div>
        @empty
            <p class="text-center">Belum ada laporan</p>
        @endforelse

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $reports->links() }}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
