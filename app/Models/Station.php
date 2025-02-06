<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Station extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city', 'totalCollected'];

    public function tollRecords()
    {
        return $this->hasMany(TollRecord::class, 'tollStation_Id');
    }
}