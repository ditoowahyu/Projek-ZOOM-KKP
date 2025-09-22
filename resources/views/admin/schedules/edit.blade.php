<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Zoom</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            min-height: 100vh;
        }
        .navbar {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 0.8s ease;
        }
        .card-header {
            border-radius: 15px 15px 0 0 !important;
        }
        .btn-success {
            background: #28a745;
            border: none;
            transition: 0.3s;
        }
        .btn-success:hover {
            background: #218838;
            transform: scale(1.05);
        }
        .btn-secondary {
            transition: 0.3s;
        }
        .btn-secondary:hover {
            transform: scale(1.05);
        }
        h2 {
            color: white;
            font-weight: bold;
            animation: fadeInDown 1s ease;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center animate__animated animate__fadeInDown">✏️ Edit Jadwal Zoom</h2>

    <div class="card animate__animated animate__fadeInUp">
        <div class="card-header bg-warning text-dark fw-bold">Form Edit Jadwal</div>
        <div class="card-body">
            <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Meeting</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title', $schedule->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Meeting ID</label>
                    <input type="text" name="meeting_id" class="form-control"
                           value="{{ old('meeting_id', $schedule->meeting_id) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password (opsional)</label>
                    <input type="text" name="password" class="form-control"
                           value="{{ old('password', $schedule->password) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal & Waktu</label>
                    <input type="datetime-local" name="schedule_time" class="form-control"
                           value="{{ old('schedule_time', \Carbon\Carbon::parse($schedule->schedule_time)->format('Y-m-d\TH:i')) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Anggota</label>
                    <select name="anggota_id" class="form-select">
                        <option value="">-- Pilih Anggota --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                {{ old('anggota_id', $schedule->anggota_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Perwira</label>
                    <select name="perwira_id" class="form-select">
                        <option value="">-- Pilih Perwira --</option>
                        @foreach ($perwira as $p)
                            <option value="{{ $p->id }}"
                                {{ old('perwira_id', $schedule->perwira_id) == $p->id ? 'selected' : '' }}>
                                {{ $p->nama }} ({{ $p->nrp }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary px-4">⬅️ Batal</a>
                    <button type="submit" class="btn btn-success px-4">💾 Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
