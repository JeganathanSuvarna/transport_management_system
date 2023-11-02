<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table='route_infos';

    protected $fillable=[
        'route_name',
        'start_point',
        'end_point',
        'distance'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
