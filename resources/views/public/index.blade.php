<x-app-layout>
    <h1 class="text-xl font-bold">Jadwal Zoom</h1>
    <ul>
        @foreach($schedules as $s)
            <li>
                <strong>{{ $s->title }}</strong> - 
                {{ $s->schedule_time }} <br>
                Meeting ID: {{ $s->meeting_id }} | Pass: {{ $s->password }}
            </li>
        @endforeach
    </ul>
</x-app-layout>
