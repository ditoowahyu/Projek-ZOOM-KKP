<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ZoomSchedule; // ✅ tambahkan ini

class Perwira extends Model
{
    use HasFactory;

    protected $table = 'perwira'; // nama tabel sesuai DB
    
    protected $fillable = [
        'nama',
        'nrp',
        'no_hp',
        'email',
    ];

    public function schedules()
    {
        return $this->hasMany(ZoomSchedule::class, 'perwira_id');
    }
}
