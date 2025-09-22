<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Zoom</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-50 to-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-3xl p-6">
        <div class="bg-white shadow-lg rounded-xl p-8">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Tambah Jadwal Zoom</h2>

            <form action="{{ route('admin.schedules.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="title" class="block text-gray-700 font-medium mb-1">Judul Meeting</label>
                    <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                </div>

                <div>
                    <label for="meeting_id" class="block text-gray-700 font-medium mb-1">Meeting ID</label>
                    <input type="text" name="meeting_id" id="meeting_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-1">Password (opsional)</label>
                    <input type="text" name="password" id="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <div>
                    <label for="schedule_time" class="block text-gray-700 font-medium mb-1">Tanggal & Waktu</label>
                    <input type="datetime-local" name="schedule_time" id="schedule_time" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                </div>

                <div>
                    <label for="perwira_id" class="block text-gray-700 font-medium mb-1">Perwira</label>
                    <select name="perwira_id" id="perwira_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">-- Pilih Perwira --</option>
                        @if ($perwira->count())
                            @foreach ($perwira as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }} ({{ $p->nrp }})</option>
                            @endforeach
                        @else
                            <option value="" disabled>Data perwira tidak tersedia</option>
                        @endif
                    </select>
                </div>

                <div>
                    <label for="anggota_id" class="block text-gray-700 font-medium mb-1">Anggota</label>
                    <select name="anggota_id" id="anggota_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">-- Pilih Anggota --</option>
                        @if ($users->count())
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        @else
                            <option value="" disabled>Data anggota tidak tersedia</option>
                        @endif
                    </select>
                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <a href="{{ route('admin.schedules.index') }}" class="px-6 py-2 bg-gray-400 hover:bg-gray-500 text-white font-semibold rounded-lg transition">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition"> Simpan</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
