<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Station;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(StationSeeder::class);
    }

    public function test_CheckIfCanListStations()
    {
        $response = $this->getJson('/api/stations');

        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }

    public function test_CheckIfCanCreateStation()
    {
        $stationData = [
            'name' => 'Station 3',
            'city' => 'Sevilla'
        ];

        $response = $this->postJson('/api/stations', $stationData);

        $response->assertStatus(201)
                 ->assertJsonFragment($stationData);
    }

    public function test_CheckIfCanShowStation()
    {
        $station = Station::first();

        $response = $this->getJson("/api/stations/{$station->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'name' => $station->name,
                     'city' => $station->city
                 ]);
    }

    public function test_CheckIfCanUpdateStation()
    {
        $station = Station::first();

        $updateData = [
            'name' => 'Updated Station',
            'city' => 'Updated City'
        ];

        $response = $this->putJson("/api/stations/{$station->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJsonFragment($updateData);
    }

    public function test_CheckIfCanDeleteStation()
    {
        $station = Station::first();

        $response = $this->deleteJson("/api/stations/{$station->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Station deleted successfully']);
    }
}
