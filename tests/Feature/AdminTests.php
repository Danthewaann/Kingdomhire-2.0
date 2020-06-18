<?php

namespace Tests\Feature;

use App\User;
use App\Hire;
use App\Vehicle;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @property mixed user
 */
class AdminTests extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->vehicle = null;
        $this->user = factory(User::class)->create();
    }

    public function tearDown(): void
    {
        $this->user->delete();
        if (!is_null($this->vehicle)) {
            $this->vehicle->forceDelete();
            $this->vehicle = null;
        }
        $this->flushSession();
        parent::tearDown();
    }

    /**
     * Sends a GET request to the admin home page
     * 
     * @test
     */
    public function getHomePage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.home'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.admin-home');
    }

    /**
     * Sends a GET request to admin report generation page
     * 
     * @test
     */
    public function generateHiresPerVehicleReport()
    {
        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::now()->addDay()->format('Y-m-d');
        $this->vehicle = factory(Vehicle::class)->create();
        Hire::create([
            'start_date' => $today,
            'end_date' => $tomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.report'));
        $response->assertStatus(200);
    }

    /**
     * Sends a GET request to admin report generation page with no hires in the database
     * TODO
     * @test
     */
    // public function generateHiresPerVehicleReportWithNoHires()
    // {
    //     $today = Carbon::now()->format('Y-m-d');
    //     $tomorrow = Carbon::now()->addDay()->format('Y-m-d');
    //     $this->vehicle = factory(Vehicle::class)->create();
    //     Hire::create([
    //         'start_date' => $today,
    //         'end_date' => $tomorrow,
    //         'vehicle_id' => $this->vehicle->id
    //     ]);

    //     $response = $this->actingAs($this->user)->get(route('admin.report'));
    //     $response->assertStatus(200);
    // }
}
