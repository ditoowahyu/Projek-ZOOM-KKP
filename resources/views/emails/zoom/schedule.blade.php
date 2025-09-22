<x-mail::message>
# 📅 Jadwal Zoom Baru

Halo, ada jadwal Zoom baru yang ditambahkan:

- **Judul:** {{ $schedule->title }}
- **Meeting ID:** {{ $schedule->meeting_id }}
- **Password:** {{ $schedule->password ?? '-' }}
- **Waktu:** {{ \Carbon\Carbon::parse($schedule->schedule_time)->format('d M Y H:i') }}

<x-mail::button :url="'#'">
Gabung ke Zoom
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
