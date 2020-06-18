<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\VehicleType;

class VehicleTypeTests extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->vehicle_type = null;
        $this->user = factory(User::class)->create();
    }

    public function tearDown(): void
    {
        $this->user->delete();
        if (!is_null($this->vehicle_type)) {
            $this->vehicle_type->delete();
            $this->vehicle_type = null;
        }
        $this->flushSession();
        parent::tearDown();
    }

    /**
     * Sends a GET request to the admin vehicle types page
     * 
     * @test
     */
    public function getVehicleTypesPage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.vehicle-types.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.admin-vehicle-types');
    }

    /**
     * Sends a GET request to the admin vehicle types creation page
     * 
     * @test
     */
    public function getVehicleTypeCreationPage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.vehicle-types.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.vehicle-type.create');
    }

    /**
     * Sends a GET request to the admin vehicle type edit page
     * 
     * @test
     */
    public function getVehicleTypeEditPage()
    {
        $this->vehicle_type = VehicleType::create(['name' => 'test_vehicle_type']);
        $response = $this->actingAs($this->user)->get(route('admin.vehicle-types.edit', ['vehicle_type' => $this->vehicle_type->slug]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.vehicle-type.edit');
    }

    /**
     * Sends a POST request to create a vehicle type with valid attributes
     * 
     * @test
     */
    public function createVehicleTypeWithValidAttributes()
    {
        $data = ['name' => 'test_vehicle_type'];
        $response = $this->actingAs($this->user)->post(route('admin.vehicle-types.store'), $data);

        $this->vehicle_type = VehicleType::where($data)->get()->first();

        $response->assertStatus(302);
        $response->assertSessionHas('status.vehicle_type', 'Successfully created vehicle type!');
        $this->assertDatabaseHas('vehicle_types', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Sends a POST request to create a vehicle type with invalid attributes
     * 
     * @test
     */
    public function createVehicleTypeWithInvalidAttributes()
    {
        $data = ['name' => null];
        $response = $this->actingAs($this->user)->post(route('admin.vehicle-types.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseMissing('vehicle_types', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Sends a POST request to create a vehicle type that already exists
     * 
     * @test
     */
    public function createVehicleTypeThatAlreadyExists()
    {
        $data = ['name' => 'test_vehicle_type'];
        $this->vehicle_type = VehicleType::create($data);

        $response = $this->actingAs($this->user)->post(route('admin.vehicle-types.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseHas('vehicle_types', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Sends a PUT request to create a vehicle type with valid attributes
     * 
     * @test
     */
    public function updateVehicleTypeWithValidAttributes()
    {
        $this->vehicle_type = VehicleType::create(['name' => 'test_vehicle_type']);
        $response = $this->actingAs($this->user)->put(route('admin.vehicle-types.update', ['vehicle_type' => $this->vehicle_type->slug]), [
            'name' => 'test_vehicle_type_new'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status.vehicle_type', 'Successfully updated vehicle type!');
        $this->assertDatabaseHas('vehicle_types', [
            'name' => 'test_vehicle_type_new',
        ]);
    }

    /**
     * Sends a PUT request to update a vehicle type with invalid attributes
     * 
     * @test
     */
    public function updateVehicleTypeWithInvalidAttributes()
    {
        $this->vehicle_type = VehicleType::create(['name' => 'test_vehicle_type']);
        $response = $this->actingAs($this->user)->put(route('admin.vehicle-types.update', ['vehicle_type' => $this->vehicle_type->slug]), [
            'name' => null
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseMissing('vehicle_types', [
            'name' => null,
        ]);
    }

    /**
     * Sends a PUT request to update a vehicle type with a name 
     * that is already assigned to another vehicle type
     * 
     * @test
     */
    public function updateVehicleTypeThatAlreadyExists()
    {
        $this->vehicle_type = VehicleType::create(['name' => 'test_vehicle_type']);
        $other_vehicle_type = VehicleType::create(['name' => 'test_other_vehicle_type']);
        
        $response = $this->actingAs($this->user)->put(route('admin.vehicle-types.update', ['vehicle_type' => $this->vehicle_type->slug]), [
            'name' => 'test_other_vehicle_type'
        ]);

        $other_vehicle_type->delete();
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseHas('vehicle_types', [
            'name' => 'test_vehicle_type',
        ]);
    }

    /**
     * Sends a DELETE request to delete a vehicle type 
     * 
     * @test
     */
    public function deleteVehicleType()
    {
        $this->vehicle_type = VehicleType::create(['name' => 'test_vehicle_type']);
        
        $response = $this->actingAs($this->user)->delete(route('admin.vehicle-types.destroy', ['vehicle_type' => $this->vehicle_type->slug]));

        $response->assertStatus(302);
        $response->assertSessionHas('status.vehicle_type', 'Successfully deleted vehicle type!');
        $this->assertDatabaseMissing('vehicle_types', [
            'name' => 'test_vehicle_type',
        ]);
    }
}
