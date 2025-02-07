<?php

namespace Database\Seeders;

use App\Models\Record;
use App\Models\Station;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $station1 = Station::create([
            'name' => 'Station 1',
            'city' => 'Málaga',
        ]);

        $station2 = Station::create([
            'name' => 'Station 2',
            'city' => 'Cadíz',
        ]);
    
        $vehicle1 = Vehicle::create([
            'plate' => 'ABC193',
            'type' => 'car',
            'axles' => 0
        ]);
    
        $vehicle2 = Vehicle::create([
            'plate' => 'DEF456',
            'type' => 'motorcycle',
            'axles' => 0
        ]);
    
        $vehicle3 = Vehicle::create([
            'plate' => 'GHI789',
            'type' => 'truck',
            'axles' => 4
        ]);
    
        $this->createTollRecord($station1, $vehicle1);
        $this->createTollRecord($station1, $vehicle2);
        $this->createTollRecord($station1, $vehicle3);
        $this->createTollRecord($station2, $vehicle1);
        $this->createTollRecord($station2, $vehicle2);
        $this->createTollRecord($station2, $vehicle3);
    }
    
    private function createTollRecord($station, $vehicle)
    {
        
        if ($vehicle->type == 'car') {
            $amount = 100;
        } elseif ($vehicle->type == 'motorcycle') {
            $amount = 50;
        } elseif ($vehicle->type == 'truck') {
            $amount = 50 * $vehicle->axles;
        }
    
        $record = Record::create([
            'station_id' => $station->id,
            'vehicle_id' => $vehicle->id,
            'amount' => $amount,
        ]);
    
        $station->total_collected += $amount;
        $station->save();
    }

}
