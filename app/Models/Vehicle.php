<?php

namespace App\Models;

use App\Models\Record;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['plate', 'type', 'axles'];

    public function records()
    {
        return $this->hasMany(Record::class, 'vehicle_Id');
    }

    public function calculateToll()
    {
        return match ($this->type) {
            'car' => 100,
            'motorcycle' => 50,
            'truck' => $this->axles * 50,
        };
    }
}
