<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan Zoom</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-yHnmvP+4/kW6Bj+Fnp+0KM+1Kgj1R7IYy0IoK3J6r7UpxPz7pJ1UuFhrqTkU1qE+7jtzZxyYKMN5RSm9rXh1aw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* ===== Body & center form ===== */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7f9;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* ===== Card Form ===== */
        .card-custom {
            background-color: #fff;
            width: 100%;
            max-width: 600px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
        }

        .card-custom h4 {
            font-size: 1.5rem;
            margin-bottom: 25px;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], input[type="file"], textarea {
            width: 100%;
            padding: 10px 15px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 1rem;
            box-sizing: border-box;
            margin-bottom: 10px;
            transition: border 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus,
        input[type="file"]:focus {
            outline: none;
            border-color: #facc15; /* kuning */
            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.2);
        }

        .text-muted {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .text-danger {
            font-size: 0.85rem;
            color: #dc3545;
        }

        /* ===== Tombol ===== */
        .btn-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            background-color: #facc15; /* kuning */
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-custom:hover {
            background-color: #eab308; /* kuning gelap */
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            background-color: #e0e0e0;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-back:hover {
            background-color: #cacaca;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .me-2 {
            margin-right: 0.5rem;
        }

    </style>
</head>
<body>

<form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="card-custom">
    @csrf
    <h4 class="text-center text-dark">
        <i class="fas fa-file-alt me-2" style="color:#facc15"></i> Buat Laporan Baru
    </h4>

    <!-- Judul -->
    <div class="mb-3">
        <label for="title">Judul Laporan</label>
        <input type="text" name="title" id="title" placeholder="Masukkan judul laporan" required
               value="{{ old('title') }}">
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Deskripsi -->
    <div class="mb-3">
        <label for="description">Deskripsi</label>
        <textarea name="description" id="description" rows="4" placeholder="Tuliskan deskripsi laporan" required>{{ old('description') }}</textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Gambar -->
    <div class="mb-3">
        <label for="image">Upload Gambar</label>
        <input type="file" name="image" id="image" accept="image/*">
        <small class="text-muted">Format: JPG, JPEG, PNG (Maks: 2MB)</small>
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Tombol -->
    <div class="button-group">
        <a href="{{ route('reports.index') }}" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
        <button type="submit" class="btn-custom">
            <i class="fas fa-paper-plane me-2"></i> Kirim Laporan
        </button>
    </div>
</form>

</body>
</html>
