<?php

namespace App\Models;

use App\Models\Station;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Record extends Model
{
    use HasFactory;

    protected $fillable = ['station_id', 'vehicle_id', 'amount'];

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
