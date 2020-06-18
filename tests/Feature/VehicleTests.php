<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Vehicle;
use Carbon\Carbon;
use Session;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class VehicleTests extends TestCase
{
    use WithFaker;

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
     * Sends a GET request to the admin vehicles page
     * 
     * @test
     */
    public function getVehiclesPage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.vehicles.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.admin-vehicles');
    }

    /**
     * Sends a GET request to the admin vehicles creation page
     * 
     * @test
     */
    public function getVehicleCreationPage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.vehicles.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.vehicle.create');
    }

    /**
     * Sends a GET request to a vehicle edit page
     * 
     * @test
     */
    public function getVehicleEditPage()
    {
        $this->vehicle = factory(Vehicle::class)->create();
        $response = $this->actingAs($this->user)->get(route('admin.vehicles.edit', ['vehicle' => $this->vehicle->slug]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.vehicle.edit');
    }

    /**
     * Sends a GET request to an active vehicle dashboard
     * 
     * @test
     */
    public function getActiveVehicleDashboard()
    {
        $this->vehicle = factory(Vehicle::class)->create();
        $response = $this->actingAs($this->user)->get(route('admin.vehicles.show', ['vehicle' => $this->vehicle->slug]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.vehicle.dashboards.active');
    }

    /**
     * Sends a GET request to an inactive vehicle dashboard
     * 
     * @test
     */
    public function getInactiveVehicleDashboard()
    {
        $this->vehicle = factory(Vehicle::class)->create();
        $this->vehicle->delete();
        $response = $this->actingAs($this->user)->get(route('admin.vehicles.show', ['vehicle' => $this->vehicle->slug]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.vehicle.dashboards.discontinued');
    }

    /**
     * Sends a POST request to create a vehicle with valid attributes
     * 
     * @test
     */
    public function CreateVehicleWithValidAttributes()
    {
        $this->vehicle = factory(Vehicle::class)->make();
        $response = $this->actingAs($this->user)->post(route('admin.vehicles.store'), $this->vehicle->getAttributes());

        $this->vehicle = Vehicle::where([
            'make' => $this->vehicle->make, 
            'model' => $this->vehicle->model
        ])->get()->first();

        $response->assertStatus(302);
        $response->assertSessionHas('status', [
            'Successfully created vehicle!', 
            'ID = ' . $this->vehicle->name,
            'Name = ' . $this->vehicle->make_model
        ]);
        $this->assertDatabaseHas('vehicles', [
            'id' => $this->vehicle->id,
            'name' => $this->vehicle->name,
            'make' => $this->vehicle->make,
            'model' => $this->vehicle->model
        ]);
    }

    /**
     * Sends a POST request to create a vehicle with valid attributes and images
     * 
     * @test
     */
    public function CreateVehicleWithValidAttributesAndImages()
    {
        Storage::fake('public');
        $this->vehicle = factory(Vehicle::class)->make();

        $data = $this->vehicle->getAttributes();
        $fake_image = UploadedFile::fake()->image('test.jpg', 500, 500);
        $data['vehicle_images_add'] = [$fake_image];

        $response = $this->actingAs($this->user)->post(route('admin.vehicles.store'), $data);

        $this->vehicle = Vehicle::where([
            'make' => $this->vehicle->make, 
            'model' => $this->vehicle->model
        ])->get()->first();

        $response->assertStatus(302);
        $response->assertSessionHas('status', [
            'Successfully created vehicle!', 
            'ID = ' . $this->vehicle->name,
            'Name = ' . $this->vehicle->make_model
        ]);

        $db_image = $this->vehicle->images->sortBy('created_at')->first();
        $this->assertNotNull($db_image);
        Storage::disk('public')->assertExists('imgs/'.$this->vehicle->name.'/'.$db_image->name);
    }

    /**
     * Sends a POST request to attempt to create a vehicle with invalid attributes
     * 
     * @test
     */
    public function CreateVehicleWithInvalidAttributes()
    {
        $this->vehicle = factory(Vehicle::class)->make();
        $this->vehicle->make = null;
        $response = $this->actingAs($this->user)->post(route('admin.vehicles.store'), $this->vehicle->getAttributes());

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('default', ['make']);
        $this->assertDatabaseMissing('vehicles', [
            'make' => $this->vehicle->make,
            'model' => $this->vehicle->model
        ]);
    }

    /**
     * Sends a POST request to update a vehicle with valid attributes
     * 
     * @test
     */
    public function UpdateVehicleWithValidAttributes()
    {
        $this->vehicle = factory(Vehicle::class)->create();
        $this->vehicle->make = "test";
        $response = $this->actingAs($this->user)->put(route('admin.vehicles.update', ['vehicle' => $this->vehicle->slug]), $this->vehicle->getAttributes());

        $this->vehicle = Vehicle::where([
            'make' => $this->vehicle->make, 
            'model' => $this->vehicle->model
        ])->get()->first();

        $response->assertStatus(302);
        $response->assertSessionHas('status', [
            'Successfully updated vehicle!', 
            'ID = ' . $this->vehicle->name,
            'Name = ' . $this->vehicle->make_model
        ]);
        $this->assertDatabaseHas('vehicles', [
            'id' => $this->vehicle->id,
            'name' => $this->vehicle->name,
            'make' => $this->vehicle->make,
            'model' => $this->vehicle->model
        ]);
    }

    /**
     * Sends a POST request to update a vehicle with invalid attributes
     * 
     * @test
     */
    public function UpdateVehicleWithInvalidAttributes()
    {
        $this->vehicle = factory(Vehicle::class)->create();
        $orig_make = $this->vehicle->make;
        $this->vehicle->make = null;
        $response = $this->actingAs($this->user)->put(route('admin.vehicles.update', ['vehicle' => $this->vehicle->slug]), $this->vehicle->getAttributes());

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('default', ['make']);
        $this->assertDatabaseHas('vehicles', [
            'id' => $this->vehicle->id,
            'name' => $this->vehicle->name,
            'make' => $orig_make,
            'model' => $this->vehicle->model
        ]);
    }

    /**
     * Sends a DELETE request to delete a vehicle
     * 
     * @test
     */
    public function DeleteVehicle()
    {
        $this->vehicle = factory(Vehicle::class)->create();
        $response = $this->actingAs($this->user)->delete(route('admin.vehicles.destroy', ['vehicle' => $this->vehicle->slug]));

        $response->assertStatus(302);
        $response->assertSessionHas('status', [
            'Successfully deleted vehicle!', 
            'ID = ' . $this->vehicle->name,
            'Name = ' . $this->vehicle->make_model
        ]);
        $this->assertDatabaseMissing('vehicles', [
            'id' => $this->vehicle->id
        ]);
    }

    /**
     * Sends a PATCH request to discontinue a vehicle
     * 
     * @test
     */
    public function DiscontinueVehicle()
    {
        $this->vehicle = factory(Vehicle::class)->create();
        $response = $this->actingAs($this->user)->patch(route('admin.vehicles.discontinue', ['vehicle' => $this->vehicle->slug]));

        $response->assertStatus(302);
        $response->assertSessionHas('status', [
            'Successfully discontinued vehicle!', 
            'ID = ' . $this->vehicle->name,
            'Name = ' . $this->vehicle->make_model
        ]);
        $this->assertDatabaseHas('vehicles', [
            'id' => $this->vehicle->id,
            'status' => "Unavailable"
        ]);
    }

    /**
     * Sends a PATCH request to recontinue a vehicle
     * 
     * @test
     */
    public function RecontinueVehicle()
    {
        $this->vehicle = factory(Vehicle::class)->create();
        $this->vehicle->update(['status' => 'Unavailable']);
        $response = $this->actingAs($this->user)->patch(route('admin.vehicles.recontinue', ['vehicle' => $this->vehicle->slug]));

        $response->assertStatus(302);
        $response->assertSessionHas('status', [
            'Successfully re-continued vehicle!', 
            'ID = ' . $this->vehicle->name,
            'Name = ' . $this->vehicle->make_model
        ]);
        $this->assertDatabaseHas('vehicles', [
            'id' => $this->vehicle->id,
            'status' => "Available"
        ]);
    }
}
