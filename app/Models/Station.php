<?php

namespace App\Models;

use App\Models\Record;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Station extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city', 'totalCollected'];

    public function records()
    {
        return $this->hasMany(Record::class, 'stationId');
    }
}