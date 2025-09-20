<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'meeting_id',
        'password',
        'schedule_time',
    ];

    // Casting schedule_time ke Carbon
    protected $casts = [
        'schedule_time' => 'datetime',
    ];
}
