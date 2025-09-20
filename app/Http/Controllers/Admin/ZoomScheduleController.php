<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZoomSchedule;
use Illuminate\Http\Request;

class ZoomScheduleController extends Controller
{
    // ✅ daftar jadwal
    public function index()
{
    // urut lama → baru (id asc) agar posisi stabil
    $schedules = ZoomSchedule::orderBy('id', 'asc')->get();

    return view('admin.schedules.index', compact('schedules'));
}


    // ✅ form tambah
    public function create()
    {
        return view('admin.schedules.create');
    }

    // ✅ simpan jadwal baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meeting_id' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'schedule_time' => 'required|date',
        ]);

        ZoomSchedule::create($request->all());

        return redirect()->route('admin.schedules.index')
                         ->with('success', 'Jadwal Zoom berhasil ditambahkan!');
    }

    // ✅ form edit
    public function edit(ZoomSchedule $schedule)
    {
        return view('admin.schedules.edit', compact('schedule'));
    }

    // ✅ update jadwal
    public function update(Request $request, ZoomSchedule $schedule)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meeting_id' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'schedule_time' => 'required|date',
        ]);

        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')
                         ->with('success', 'Jadwal Zoom berhasil diperbarui!');
    }

    // ✅ hapus jadwal
    public function destroy(ZoomSchedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
                         ->with('success', 'Jadwal Zoom berhasil dihapus!');
    }
}
