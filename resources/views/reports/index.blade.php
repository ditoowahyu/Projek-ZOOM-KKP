<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan - POLDA Maluku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary: #3a3a3a;
            --secondary: #ffcc00;
            --light: #f8f9fa;
        }

        body {
            background-color: #f5f7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 80px;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, #2c2c2c 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-bottom: 4px solid var(--secondary);
        }

        .page-title {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card-header-custom {
            background: linear-gradient(120deg, var(--primary) 0%, #4a4a4a 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem 1.5rem;
            border-bottom: 3px solid var(--secondary);
        }

        .report-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 5px;
        }

        .no-image {
            width: 100%;
            height: 180px;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            color: #888;
        }

        .btn-primary-custom {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
            color: var(--primary);
        }

        .badge-date {
            background-color: #1c1d1f;
            color: #e3db04;
            font-weight: 500;
        }

        .pagination-custom .page-link {
            color: var(--primary);
            border: 1px solid #dee2e6;
        }

        .pagination-custom .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination-custom .page-link:hover {
            color: var(--primary);
            background-color: #f8f9fa;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 5rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        .description-truncate {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ✅ Tambahan biar judul report jadi putih */
        .card-title {
            color: #fff !important;
        }

        @media (max-width: 768px) {
            .card-custom {
                margin-bottom: 15px;
            }

            .report-image {
                height: 150px;
            }
        }
    </style>

</head>

<body>
    @include('schedules.navbar')

    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title"><i class="fas fa-file-alt me-2"></i>Daftar Laporan</h1>
                    <p class="lead mb-0">Kelola dan pantau laporan yang telah Anda buat</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('reports.create') }}" class="btn btn-light text-primary fw-semibold">
                        <i class="fas fa-plus-circle me-2"></i>Buat Laporan Baru
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        @if ($reports->count() > 0)
            <div class="row">
                @foreach ($reports as $report)
                    <div class="col-lg-6 col-xl-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="card card-custom h-100">
                            <div
                                class="card-header card-header-custom d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">{{ Str::limit($report->title, 28) }}</h5>
                                <span class="badge badge-date">
                                    <i class="far fa-clock me-1"></i>{{ $report->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    @if ($report->image)
                                        <img src="{{ asset('storage/' . $report->image) }}" alt="Laporan Image"
                                            class="report-image">
                                    @else
                                        <div class="no-image">
                                            <i class="far fa-image fa-3x"></i>
                                        </div>
                                    @endif
                                </div>
                                <p class="card-text description-truncate">{{ $report->description }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i>{{ $report->user->name }}
                                    </small>
                                    <div>
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editReportModal{{ $report->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editReportModal{{ $report->id }}" tabindex="-1"
                        aria-labelledby="editReportModalLabel{{ $report->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-white">
                                    <h5 class="modal-title" id="editReportModalLabel{{ $report->id }}"><i
                                            class="fas fa-edit me-2"></i>Edit Laporan</h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('reports.update', $report->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="title{{ $report->id }}" class="form-label">Judul
                                                Laporan</label>
                                            <input type="text" name="title" class="form-control"
                                                id="title{{ $report->id }}" value="{{ $report->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description{{ $report->id }}"
                                                class="form-label">Deskripsi</label>
                                            <textarea name="description" class="form-control" id="description{{ $report->id }}" rows="4" required>{{ $report->description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gambar</label>
                                            @if ($report->image)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $report->image) }}"
                                                        alt="Current Image" class="img-thumbnail"
                                                        style="max-height: 150px;">
                                                </div>
                                            @endif
                                            <input type="file" name="image" class="form-control">
                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                                gambar.</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-custom">
                        {{ $reports->links() }}
                    </ul>
                </nav>
            </div>
        @else
            <div class="empty-state" data-aos="fade-up">
                <i class="fas fa-file-alt"></i>
                <h3>Belum ada laporan</h3>
                <p>Anda belum membuat laporan apapun. Klik tombol di bawah untuk membuat laporan pertama Anda.</p>
                <a href="{{ route('reports.create') }}" class="btn btn-primary-custom mt-3">
                    <i class="fas fa-plus-circle me-2"></i>Buat Laporan Pertama
                </a>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Initialize AOS animation
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        });
    </script>
</body>

</html>
