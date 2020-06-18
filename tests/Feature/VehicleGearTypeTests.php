<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\VehicleGearType;

class VehicleGearTypeTests extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->gear_type = null;
        $this->user = factory(User::class)->create();
    }

    public function tearDown(): void
    {
        $this->user->delete();
        if (!is_null($this->gear_type)) {
            $this->gear_type->delete();
            $this->gear_type = null;
        }
        $this->flushSession();
        parent::tearDown();
    }

    /**
     * Sends a GET request to the admin vehicle gear types page
     * 
     * @test
     */
    public function getVehicleGearTypesPage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.vehicle-gear-types.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.admin-vehicle-gear-types');
    }

    /**
     * Sends a GET request to the admin vehicle gear types creation page
     * 
     * @test
     */
    public function getVehicleGearTypesCreationPage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.vehicle-gear-types.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.vehicle-gear-type.create');
    }

    /**
     * Sends a GET request to the admin vehicle gear type edit page
     * 
     * @test
     */
    public function getVehicleGearTypeEditPage()
    {
        $this->gear_type = VehicleGearType::create(['name' => 'test_gear_type']);
        $response = $this->actingAs($this->user)->get(route('admin.vehicle-gear-types.edit', ['vehicle_gear_type' => $this->gear_type->slug]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.vehicle-gear-type.edit');
    }

    /**
     * Sends a POST request to create a vehicle gear type with valid attributes
     * 
     * @test
     */
    public function createVehicleGearTypeWithValidAttributes()
    {
        $data = ['name' => 'test_gear_type'];
        $response = $this->actingAs($this->user)->post(route('admin.vehicle-gear-types.store'), $data);

        $this->gear_type = VehicleGearType::where($data)->get()->first();

        $response->assertStatus(302);
        $response->assertSessionHas('status.vehicle_gear_type', 'Successfully created gear type!');
        $this->assertDatabaseHas('vehicle_gear_types', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Sends a POST request to create a vehicle gear type with invalid attributes
     * 
     * @test
     */
    public function createVehicleGearTypeWithInvalidAttributes()
    {
        $data = ['name' => null];
        $response = $this->actingAs($this->user)->post(route('admin.vehicle-gear-types.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseMissing('vehicle_gear_types', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Sends a POST request to create a vehicle gear type that already exists
     * 
     * @test
     */
    public function createVehicleGearTypeThatAlreadyExists()
    {
        $data = ['name' => 'test_gear_type'];
        $this->gear_type = VehicleGearType::create($data);

        $response = $this->actingAs($this->user)->post(route('admin.vehicle-gear-types.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseHas('vehicle_gear_types', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Sends a PUT request to create a vehicle gear type with valid attributes
     * 
     * @test
     */
    public function updateVehicleGearTypeWithValidAttributes()
    {
        $this->gear_type = VehicleGearType::create(['name' => 'test_gear_type']);
        $response = $this->actingAs($this->user)->put(route('admin.vehicle-gear-types.update', ['vehicle_gear_type' => $this->gear_type->slug]), [
            'name' => 'test_gear_type_new'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status.vehicle_gear_type', 'Successfully updated gear type!');
        $this->assertDatabaseHas('vehicle_gear_types', [
            'name' => 'test_gear_type_new',
        ]);
    }

    /**
     * Sends a PUT request to update a vehicle gear type with invalid attributes
     * 
     * @test
     */
    public function updateVehicleGearTypeWithInvalidAttributes()
    {
        $this->gear_type = VehicleGearType::create(['name' => 'test_gear_type']);
        $response = $this->actingAs($this->user)->put(route('admin.vehicle-gear-types.update', ['vehicle_gear_type' => $this->gear_type->slug]), [
            'name' => null
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseMissing('vehicle_gear_types', [
            'name' => null,
        ]);
    }

    /**
     * Sends a PUT request to update a vehicle gear type with a name 
     * that is already assigned to another vehicle gear type
     * 
     * @test
     */
    public function updateVehicleGearTypeThatAlreadyExists()
    {
        $this->gear_type = VehicleGearType::create(['name' => 'test_gear_type']);
        $other_gear_type = VehicleGearType::create(['name' => 'test_other_gear_type']);
        
        $response = $this->actingAs($this->user)->put(route('admin.vehicle-gear-types.update', ['vehicle_gear_type' => $this->gear_type->slug]), [
            'name' => 'test_other_gear_type'
        ]);

        $other_gear_type->delete();
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseHas('vehicle_gear_types', [
            'name' => 'test_gear_type',
        ]);
    }

    /**
     * Sends a DELETE request to delete a vehicle gear type 
     * 
     * @test
     */
    public function deleteVehicleGearType()
    {
        $this->gear_type = VehicleGearType::create(['name' => 'test_gear_type']);
        
        $response = $this->actingAs($this->user)->delete(route('admin.vehicle-gear-types.destroy', ['vehicle_gear_type' => $this->gear_type->slug]));

        $response->assertStatus(302);
        $response->assertSessionHas('status.vehicle_gear_type', 'Successfully deleted gear type!');
        $this->assertDatabaseMissing('vehicle_gear_types', [
            'name' => 'test_gear_type',
        ]);
    }
}
