<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZoomSchedule;
use Illuminate\Http\Request;

class ZoomScheduleController extends Controller
{
    public function index()
{
    // Urutkan berdasarkan created_at ASC (lama duluan, baru belakangan)
    $schedules = \App\Models\ZoomSchedule::orderBy('created_at', 'asc')->get();

    return view('admin.schedules.index', compact('schedules'));
}


    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'meeting_id'=>'required',
            'schedule_time'=>'required|date',
        ]);

        ZoomSchedule::create($request->all());
        return redirect()->route('admin.schedules.index');
    }

    public function edit($id)
{
    $schedule = ZoomSchedule::findOrFail($id);
    return view('admin.schedules.edit', compact('schedule'));
}


    public function update(Request $request, ZoomSchedule $schedule)
    {
        $schedule->update($request->all());
        return redirect()->route('admin.schedules.index');
    }

    public function destroy(ZoomSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index');
    }
}