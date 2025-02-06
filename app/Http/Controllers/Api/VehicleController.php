<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::with('records')->get();

        return response()
        ->json($vehicles, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'plate' => 'required|string',
            'type' => 'required|in:car,motorcycle,truck',
            'axles' => 'nullable|integer'
        ]);

        if ($validatedData['type'] !== 'truck') {
            $validatedData['axles'] = 0;
        }

        $vehicle = Vehicle::create($validatedData);

        return response()
        ->json($vehicle, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($vehicle->load('records'), 200);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'plate' => 'string|unique:vehicles,plate,' . $vehicle->id,
            'type' => 'in:car,motorcycle,truck',
            'axles' => 'nullable|integer|min:0'
        ]);

        if (isset($validatedData['type']) && $validatedData['type'] !== 'truck') {
            $validatedData['axles'] = 0;
        }

        $vehicle->update($validatedData);

        return response()
        ->json($vehicle, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle->delete();
        return response()
        ->json(['message' => 'Vehicle deleted successfully'], 200);
    }

    public function totalTollPaid(Vehicle $vehicle)
    {
        $total = $vehicle->records->sum('tollFee');

        return response()->json([
            'plate' => $vehicle->plate,
            'totalTollPaid' => $total
        ], 200);
    }
}
