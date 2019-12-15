<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @property mixed user
 */
class AdminNavigationTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function tearDown()
    {
        $this->user->delete();
    }

    public function testHome()
    {
        $response = $this->actingAs($this->user)->get('/admin');
        $response->assertStatus(200);
    }

    public function testVehicles()
    {
        $response = $this->actingAs($this->user)->get('/admin/vehicles');
        $response->assertStatus(200);
    }

    public function testWeeklyRates()
    {
        $response = $this->actingAs($this->user)->get('/admin/other/weekly-rates');
        $response->assertStatus(200);
    }

    public function testVehicleTypes()
    {
        $response = $this->actingAs($this->user)->get('/admin/other/vehicle-types');
        $response->assertStatus(200);
    }

    public function testVehicleFuelTypes()
    {
        $response = $this->actingAs($this->user)->get('/admin/other/vehicle-fuel-types');
        $response->assertStatus(200);
    }

    public function testVehicleGearTypes()
    {
        $response = $this->actingAs($this->user)->get('/admin/other/vehicle-gear-types');
        $response->assertStatus(200);
    }
}
