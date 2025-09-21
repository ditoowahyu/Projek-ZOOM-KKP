<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan Zoom</title>
    @vite('resources/css/app.css')
    <script>
        // fungsi untuk buka & tutup modal
        function toggleModal(id) {
            document.getElementById(id).classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">
    @include('admin.nafbar_admin')

    <div class="container mx-auto px-4 my-8">
        <h1 class="text-2xl font-bold text-center mb-6">Data Laporan Zoom</h1>

        <!-- Alert -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
                <button type="button" onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    ✕
                </button>
            </div>
        @endif

        <!-- Table (desktop) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">No</th>
                        <th class="px-4 py-2 text-left">User</th>
                        <th class="px-4 py-2 text-left">Judul</th>
                        <th class="px-4 py-2 text-left">Deskripsi</th>
                        <th class="px-4 py-2 text-left">Gambar</th>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $report->user->name ?? 'Tidak ada' }}</td>
                            <td class="px-4 py-2">{{ $report->title }}</td>
                            <td class="px-4 py-2">{{ Str::limit($report->description, 50) }}</td>
                            <td class="px-4 py-2">
                                @if($report->image)
                                    <img src="{{ asset('storage/'.$report->image) }}" class="w-20 h-20 object-cover rounded" alt="Gambar">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $report->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <!-- Tombol Edit -->
                                <button onclick="toggleModal('editModal{{ $report->id }}')" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                    Edit
                                </button>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div id="editModal{{ $report->id }}" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6 relative">
                                <h2 class="text-xl font-bold mb-4">Edit Laporan</h2>
                                <form action="{{ route('admin.reports.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-3">
                                        <label class="block font-medium">Judul</label>
                                        <input type="text" name="title" value="{{ $report->title }}" 
                                            class="w-full border rounded px-3 py-2 mt-1">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="block font-medium">Deskripsi</label>
                                        <textarea name="description" rows="3" class="w-full border rounded px-3 py-2 mt-1">{{ $report->description }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="block font-medium">Gambar</label>
                                        @if($report->image)
                                            <img src="{{ asset('storage/'.$report->image) }}" class="w-24 h-24 object-cover mb-2 rounded">
                                        @endif
                                        <input type="file" name="image" class="w-full border rounded px-3 py-2 mt-1">
                                    </div>

                                    <div class="flex justify-end space-x-2 mt-4">
                                        <button type="button" onclick="toggleModal('editModal{{ $report->id }}')" 
                                            class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                                            Batal
                                        </button>
                                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Belum ada laporan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Cards (mobile) -->
        <div class="md:hidden space-y-4">
            @forelse($reports as $report)
                <div class="bg-white shadow rounded-lg p-4">
                    <h5 class="font-semibold text-lg">{{ $report->title }}</h5>
                    <p class="text-sm text-gray-600"><strong>User:</strong> {{ $report->user->name ?? 'Tidak ada' }}</p>
                    <p class="text-sm text-gray-600"><strong>Deskripsi:</strong> {{ $report->description }}</p>
                    @if($report->image)
                        <img src="{{ asset('storage/'.$report->image) }}" class="w-full h-40 object-cover rounded my-2" alt="Gambar">
                    @endif
                    <p class="text-sm text-gray-500"><strong>Tanggal:</strong> {{ $report->created_at->format('d-m-Y H:i') }}</p>

                    <div class="flex space-x-2 mt-2">
                        <button onclick="toggleModal('editModal{{ $report->id }}')" 
                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-sm w-1/2">
                            Edit
                        </button>
                        <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');" class="w-1/2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm w-full">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada laporan</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $reports->links() }}
        </div>
    </div>
</body>
</html>
