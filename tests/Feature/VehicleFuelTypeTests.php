<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\VehicleFuelType;

class VehicleFuelTypeTests extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->fuel_type = null;
        $this->user = factory(User::class)->create();
    }

    public function tearDown(): void
    {
        $this->user->delete();
        if (!is_null($this->fuel_type)) {
            $this->fuel_type->delete();
            $this->fuel_type = null;
        }
        $this->flushSession();
        parent::tearDown();
    }

    /**
     * Sends a GET request to the admin vehicles fuel types page
     * 
     * @test
     */
    public function getVehicleFuelTypesPage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.vehicle-fuel-types.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.admin-vehicle-fuel-types');
    }

    /**
     * Sends a GET request to the admin vehicles fuel types creation page
     * 
     * @test
     */
    public function getVehicleFuelTypeCreationPage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.vehicle-fuel-types.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.vehicle-fuel-type.create');
    }

    /**
     * Sends a GET request to the admin vehicle fuel type edit page
     * 
     * @test
     */
    public function getVehicleFuelTypeEditPage()
    {
        $this->fuel_type = VehicleFuelType::create(['name' => 'test_fuel_type']);
        $response = $this->actingAs($this->user)->get(route('admin.vehicle-fuel-types.edit', ['vehicle_fuel_type' => $this->fuel_type->slug]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.vehicle-fuel-type.edit');
    }

    /**
     * Sends a POST request to create a vehicle fuel type with valid attributes
     * 
     * @test
     */
    public function createVehicleFuelTypeWithValidAttributes()
    {
        $data = ['name' => 'test_fuel_type'];
        $response = $this->actingAs($this->user)->post(route('admin.vehicle-fuel-types.store'), $data);

        $this->fuel_type = VehicleFuelType::where($data)->get()->first();

        $response->assertStatus(302);
        $response->assertSessionHas('status.vehicle_fuel_type', 'Successfully created fuel type!');
        $this->assertDatabaseHas('vehicle_fuel_types', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Sends a POST request to create a vehicle fuel type with invalid attributes
     * 
     * @test
     */
    public function createVehicleFuelTypeWithInvalidAttributes()
    {
        $data = ['name' => null];
        $response = $this->actingAs($this->user)->post(route('admin.vehicle-fuel-types.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseMissing('vehicle_fuel_types', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Sends a POST request to create a vehicle fuel type that already exists
     * 
     * @test
     */
    public function createVehicleFuelTypeThatAlreadyExists()
    {
        $data = ['name' => 'test_fuel_type'];
        $this->fuel_type = VehicleFuelType::create($data);

        $response = $this->actingAs($this->user)->post(route('admin.vehicle-fuel-types.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseHas('vehicle_fuel_types', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Sends a PUT request to create a vehicle fuel type with valid attributes
     * 
     * @test
     */
    public function updateVehicleFuelTypeWithValidAttributes()
    {
        $this->fuel_type = VehicleFuelType::create(['name' => 'test_fuel_type']);
        $response = $this->actingAs($this->user)->put(route('admin.vehicle-fuel-types.update', ['vehicle_fuel_type' => $this->fuel_type->slug]), [
            'name' => 'test_fuel_type_new'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status.vehicle_fuel_type', 'Successfully updated fuel type!');
        $this->assertDatabaseHas('vehicle_fuel_types', [
            'name' => 'test_fuel_type_new',
        ]);
    }

    /**
     * Sends a PUT request to update a vehicle fuel type with invalid attributes
     * 
     * @test
     */
    public function updateVehicleFuelTypeWithInvalidAttributes()
    {
        $this->fuel_type = VehicleFuelType::create(['name' => 'test_fuel_type']);
        $response = $this->actingAs($this->user)->put(route('admin.vehicle-fuel-types.update', ['vehicle_fuel_type' => $this->fuel_type->slug]), [
            'name' => null
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseMissing('vehicle_fuel_types', [
            'name' => null,
        ]);
    }

    /**
     * Sends a PUT request to update a vehicle fuel type with a name 
     * that is already assigned to another vehicle fuel type
     * 
     * @test
     */
    public function updateVehicleFuelTypeThatAlreadyExists()
    {
        $this->fuel_type = VehicleFuelType::create(['name' => 'test_fuel_type']);
        $other_fuel_type = VehicleFuelType::create(['name' => 'test_other_fuel_type']);
        
        $response = $this->actingAs($this->user)->put(route('admin.vehicle-fuel-types.update', ['vehicle_fuel_type' => $this->fuel_type->slug]), [
            'name' => 'test_other_fuel_type'
        ]);

        $other_fuel_type->delete();
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseHas('vehicle_fuel_types', [
            'name' => 'test_fuel_type',
        ]);
    }

    /**
     * Sends a DELETE request to delete a vehicle fuel type 
     * 
     * @test
     */
    public function deleteVehicleFuelType()
    {
        $this->fuel_type = VehicleFuelType::create(['name' => 'test_fuel_type']);
        
        $response = $this->actingAs($this->user)->delete(route('admin.vehicle-fuel-types.destroy', ['vehicle_fuel_type' => $this->fuel_type->slug]));

        $response->assertStatus(302);
        $response->assertSessionHas('status.vehicle_fuel_type', 'Successfully deleted fuel type!');
        $this->assertDatabaseMissing('vehicle_fuel_types', [
            'name' => 'test_fuel_type',
        ]);
    }
}
