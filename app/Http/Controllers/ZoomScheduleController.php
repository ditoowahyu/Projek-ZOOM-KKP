<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZoomSchedule;
use Illuminate\Http\Request;
use App\Mail\ZoomScheduleNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Perwira;

class ZoomScheduleController extends Controller
{
    public function index()
    {
        $schedules = ZoomSchedule::with(['perwira', 'anggota'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $perwira = Perwira::all();
        $users   = User::all();

        return view('admin.schedules.index', compact('schedules', 'perwira', 'users'));
    }

   public function create()
{
    $users   = User::all();
    $perwira = Perwira::all();

  

    return view('admin.schedules.create', compact('users', 'perwira'));
}


    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'meeting_id'    => 'required|string|max:255',
            'password'      => 'nullable|string|max:255',
            'schedule_time' => 'required|date',
            // ✅ pakai tabel "perwira"
            'perwira_id'    => 'nullable|integer|exists:perwira,id',
            'anggota_id'    => 'nullable|integer|exists:users,id',
        ]);

        $schedule = ZoomSchedule::create($request->only([
            'title',
            'meeting_id',
            'password',
            'schedule_time',
            'perwira_id',
            'anggota_id',
        ]));

        // kirim email ke semua user
        $users = User::all();
        foreach ($users as $user) {
            try {
                Mail::to($user->email)->queue(new ZoomScheduleNotification($schedule));
            } catch (\Exception $e) {
                Mail::to($user->email)->send(new ZoomScheduleNotification($schedule));
            }
        }

        return redirect()->route('admin.schedules.index')
            ->with('success', '✅ Jadwal berhasil ditambahkan, notifikasi email sudah dikirim.');
    }

    public function edit($id)
    {
        $schedule = ZoomSchedule::findOrFail($id);
        $users    = User::all();
        $perwira  = Perwira::all();

        return view('admin.schedules.edit', compact('schedule', 'users', 'perwira'));
    }

    public function update(Request $request, ZoomSchedule $schedule)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'meeting_id'    => 'required|string|max:255',
            'password'      => 'nullable|string|max:255',
            'schedule_time' => 'required|date',
            // ✅ pakai tabel "perwira"
            'perwira_id'    => 'nullable|integer|exists:perwira,id',
            'anggota_id'    => 'nullable|integer|exists:users,id',
        ]);

        $schedule->update($request->only([
            'title',
            'meeting_id',
            'password',
            'schedule_time',
            'perwira_id',
            'anggota_id',
        ]));

        return redirect()->route('admin.schedules.index')
            ->with('success', '✏️ Jadwal berhasil diperbarui.');
    }

    public function destroy(ZoomSchedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('success', '🗑️ Jadwal berhasil dihapus.');
    }
}
