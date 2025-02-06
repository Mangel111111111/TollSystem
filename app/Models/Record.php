<?php

namespace App\Models;

use App\Models\Station;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = ['station_Id', 'vehicle_Id', 'amount'];

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_Id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_Id');
    }
}
