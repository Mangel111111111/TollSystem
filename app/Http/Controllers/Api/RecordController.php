<?php

namespace App\Http\Controllers\Api;

use App\Models\Record;
use App\Models\Station;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Record::with(['vehicle', 'station'])->get();
        
        return response()
        ->json($records, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'station_id' => 'required|exists:stations,id',
            'vehicle_id' => 'required|exists:vehicles,id'
        ]);

        $vehicle = Vehicle::findOrFail($validatedData['vehicle_id']);
        $tollFee = $vehicle->calculateToll();

        $record = Record::create([
            'station_id' => $validatedData['station_id'],
            'vehicle_id' => $validatedData['vehicle_id'],
            'amount'    => $tollFee,
        ]);

        $station = Station::findOrFail($validatedData['station_id']);
        $station->totalCollected += $tollFee;
        $station->save();

        return response()
        ->json($record, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        $record->load(['vehicle', 'station']);

        return response()
        ->json($record, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        $validatedData = $request->validate([
            'station_id' => 'sometimes|exists:stations,id',
            'vehicle_id' => 'sometimes|exists:vehicles,id',
            'amount'     => 'sometimes|numeric|min:0'
        ]);

        $record->update($validatedData);

        return response()
        ->json($record, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        $record->delete();

        return response()
        ->json(['message' => 'Record deleted successfully'], 200);
    }
}
