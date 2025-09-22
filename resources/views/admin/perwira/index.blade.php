<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PERWIRA</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    @include('admin.nafbar_admin')

    <div class="max-w-5xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Data Perwira</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tombol Tambah -->
        <button onclick="document.getElementById('createModal').classList.remove('hidden')"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4">
            + Tambah Perwira
        </button>

        <!-- Tabel Data -->
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">NRP</th>
                        <th class="px-4 py-2 border">No HP</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perwira as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $p->nama }}</td>
                            <td class="px-4 py-2 border">{{ $p->nrp }}</td>
                            <td class="px-4 py-2 border">{{ $p->no_hp }}</td>
                            <td class="px-4 py-2 border">{{ $p->email }}</td>
                            <td class="px-4 py-2 border">
                                <!-- Tombol Edit -->
                                <button
                                    onclick="document.getElementById('editModal{{ $p->id }}').classList.remove('hidden')"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">
                                    Edit
                                </button>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.perwira.destroy', $p->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus data ini?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div id="editModal{{ $p->id }}"
                            class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white rounded-lg w-full max-w-md p-6 shadow-lg">
                                <h2 class="text-xl font-semibold mb-4">Edit Perwira</h2>
                                <form action="{{ route('admin.perwira.update', $p->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="block mb-1">Nama</label>
                                        <input type="text" name="nama" value="{{ $p->nama }}"
                                            class="w-full border px-3 py-2 rounded" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">NRP</label>
                                        <input type="text" name="nrp" value="{{ $p->nrp }}"
                                            class="w-full border px-3 py-2 rounded" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">No HP</label>
                                        <input type="text" name="no_hp" value="{{ $p->no_hp }}"
                                            class="w-full border px-3 py-2 rounded">
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Email</label>
                                        <input type="email" name="email" value="{{ $p->email }}"
                                            class="w-full border px-3 py-2 rounded" required>
                                    </div>
                                    <div class="flex justify-end gap-2 mt-4">
                                        <button type="submit"
                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                                            Update
                                        </button>
                                        <button type="button"
                                            onclick="document.getElementById('editModal{{ $p->id }}').classList.add('hidden')"
                                            class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="createModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-md p-6 shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Tambah Perwira</h2>
            <form action="{{ route('admin.perwira.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="block mb-1">Nama</label>
                    <input type="text" name="nama" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">NRP</label>
                    <input type="text" name="nrp" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">No HP</label>
                    <input type="text" name="no_hp" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Email</label>
                    <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                    <button type="button" onclick="document.getElementById('createModal').classList.add('hidden')"
                        class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
