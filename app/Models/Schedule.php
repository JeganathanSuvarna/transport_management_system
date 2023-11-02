<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table='schedules';

    protected $fillable=[
        'bus_id',
        'route_id',
        'start_time',
        'end_time'
    ];
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
