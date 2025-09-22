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
        'perwira_id',
        'anggota_id',
    ];

    protected $casts = [
        'schedule_time' => 'datetime',
    ];

    // Relasi ke tabel perwira

    public function perwira()
    {
        return $this->belongsTo(Perwira::class, 'perwira_id');
    }
    public function anggota()
    {
        return $this->belongsTo(User::class, 'anggota_id');
    }
}
