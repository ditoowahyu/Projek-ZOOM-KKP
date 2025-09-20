<?php

namespace App\Http\Controllers;

use App\Models\ZoomSchedule;

class PublicScheduleController extends Controller
{
    public function index()
    {
        $schedules = ZoomSchedule::all();
        // arahkan ke view custom
        return view('schedules.index', compact('schedules'));
    }
}
