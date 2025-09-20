<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Zoom</title>
    @vite('resources/css/app.css') {{-- pastikan tailwind jalan --}}
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-blue-600 text-white shadow-md">
        <div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">📅 Jadwal Zoom</h1>
            <nav>
                <a href="/" class="hover:underline">Home</a>
                <a href="/schedules" class="ml-4 hover:underline">Jadwal</a>
            </nav>
        </div>
    </header>

    <!-- Konten -->
    <main class="max-w-5xl mx-auto px-4 py-8">
        @if($schedules->isEmpty())
            <div class="p-6 bg-white rounded-xl shadow text-center">
                <p class="text-gray-600">Belum ada jadwal Zoom.</p>
            </div>
        @else
            <div class="grid gap-6 md:grid-cols-2">
                @foreach($schedules as $s)
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h2 class="text-xl font-semibold text-blue-700 mb-2">
                            {{ $s->title }}
                        </h2>
                        <p class="text-gray-700">
                            🕒 {{ $s->schedule_time?->format('d M Y, H:i') }}
                        </p>
                        <p class="mt-2"><span class="font-medium">Meeting ID:</span> {{ $s->meeting_id }}</p>
                        <p><span class="font-medium">Password:</span> {{ $s->password ?? '-' }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white text-center py-4 mt-10">
        <p>&copy; {{ date('Y') }} Zoom Scheduler</p>
    </footer>
</body>
</html>
