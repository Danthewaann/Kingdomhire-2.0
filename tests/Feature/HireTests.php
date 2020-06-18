<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Vehicle;
use App\Hire;
use App\Reservation;
use Carbon\Carbon;

class HireTests extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->vehicle = factory(Vehicle::class)->create();
    }

    public function tearDown(): void
    {
        $this->user->delete();
        $this->vehicle->forceDelete();
        $this->flushSession();
        parent::tearDown();
    }

    /**
     * Sends a GET request to a specifc active hire edit page
     * 
     * @test
     */
    public function getActiveHireEditPage()
    {
        $today = Carbon::now()->format('Y-m-d');
        $oneWeekFromToday = Carbon::now()->addWeek()->format('Y-m-d');
        $hire = Hire::create([
            'start_date' => $today,
            'end_date' => $oneWeekFromToday,
            'vehicle_id' => $this->vehicle->id
        ]);

        $this->assertDatabaseHas('hires', [
            'start_date' => $today,
            'end_date' => $oneWeekFromToday,
            'is_active' => true,
            'vehicle_id' => $this->vehicle->id
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.hires.edit', ['hire' => $hire->name]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.hire.edit');
    }

    /**
     * Sends a GET request to a specifc inactive hire edit page
     * 
     * @test
     */
    public function attemptGetOfInactiveHireEditPage()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $dayBeforeYesterday = Carbon::yesterday()->subDay()->format('Y-m-d');
        $hire = Hire::create([
            'start_date' => $dayBeforeYesterday,
            'end_date' => $yesterday,
            'vehicle_id' => $this->vehicle->id
        ]);

        $this->assertDatabaseHas('hires', [
            'start_date' => $dayBeforeYesterday,
            'end_date' => $yesterday,
            'is_active' => false,
            'vehicle_id' => $this->vehicle->id
        ]);
        
        $response = $this->actingAs($this->user)->get(route('admin.hires.edit', ['hire' => $hire->name]));
        $response->assertStatus(404);
    }

    /**
     * Sends a POST request to book a hire with valid dates
     * 
     * @test
     */
    public function bookHireWithValidDates()
    {
        $today = Carbon::now()->format('Y-m-d');
        $oneWeekFromToday = Carbon::now()->addWeek()->format('Y-m-d');
        $response = $this->actingAs($this->user)->post(route('admin.reservations.store'), [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $today,
            'end_date' => $oneWeekFromToday
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status.reservation', 'Successfully booked hire!');
        $this->assertDatabaseHas('hires', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $today,
            'is_active' => true,
            'end_date' => $oneWeekFromToday
        ]);
    }

    /**
     * Sends a POST request to book a hire with invalid dates
     * 
     * @test
     */
    public function bookHireWithInvalidDates()
    {
        $today = Carbon::now()->format('Y-m-d');
        $response = $this->actingAs($this->user)->post(route('admin.reservations.store'), [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $today,
            'end_date' => $today
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('reservations', ['end_date']);
        $this->assertDatabaseMissing('hires', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $today,
            'end_date' => $today
        ]);
    }

    /**
     * Sends a POST request to book a hire with no vehicle id
     * 
     * @test
     */
    public function bookHireWithNoVehicleId()
    {
        $today = Carbon::now()->format('Y-m-d');
        $oneWeekFromToday = Carbon::now()->addWeek()->format('Y-m-d');
        $response = $this->actingAs($this->user)->post(route('admin.reservations.store'), [
            'vehicle_id' => null,
            'start_date' => $today,
            'end_date' => $oneWeekFromToday
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('reservations', ['vehicle_id']);
        $this->assertDatabaseMissing('hires', [
            'vehicle_id' => null,
            'start_date' => $today,
            'is_active' => true,
            'end_date' => $oneWeekFromToday
        ]);
    }

    /**
     * Sends a POST request to book a hire that conflicts with a reservation
     * 
     * @test
     */
    public function bookHireThatConflictsWithReservation()
    {
        $today = Carbon::now()->format('Y-m-d');
        $oneWeekFromToday = Carbon::now()->addWeek()->format('Y-m-d');
        $twoWeeksFromToday = Carbon::now()->addDays(14)->format('Y-m-d');

        Reservation::create([
            'start_date' => $oneWeekFromToday,
            'end_date' => $twoWeeksFromToday,
            'vehicle_id' => $this->vehicle->id
        ]);

        $response = $this->actingAs($this->user)->post(route('admin.reservations.store'), [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $today,
            'end_date' => $oneWeekFromToday
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('reservations', ['reservation', 'end_date']);
        $this->assertDatabaseMissing('hires', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $today,
            'is_active' => true,
            'end_date' => $oneWeekFromToday
        ]);
    }

    /**
     * Sends a PUT request to update an active hire 
     * 
     * @test
     */
    public function updateActiveHire()
    {
        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::now()->addDay()->format('Y-m-d');
        $oneWeekFromToday = Carbon::now()->addWeek()->format('Y-m-d');
        $hire = Hire::create([
            'start_date' => $today,
            'end_date' => $oneWeekFromToday,
            'vehicle_id' => $this->vehicle->id
        ]);

        $this->assertDatabaseHas('hires', [
            'start_date' => $today,
            'end_date' => $oneWeekFromToday,
            'is_active' => true,
            'vehicle_id' => $this->vehicle->id
        ]);
        
        $response = $this->actingAs($this->user)->put(route('admin.hires.update', ['hire' => $hire->name]), [
            'end_date' => $tomorrow
        ]);

        $hire = $hire->fresh();
        $response->assertStatus(302);
        $response->assertSessionHas('status', [
            'Successfully updated hire!',
            'ID = '.$hire->name,
            'Vehicle = '.$this->vehicle->full_name,
            'Start Date = '.date('j/M/Y', strtotime($hire->start_date)),
            'End Date = '.date('j/M/Y', strtotime($hire->end_date)),
        ]);
        $this->assertDatabaseHas('hires', [
            'start_date' => $today,
            'end_date' => $tomorrow,
            'is_active' => true,
            'vehicle_id' => $this->vehicle->id
        ]);
    }

    /**
     * Sends a PUT request to update an active hire to cnflict with a reservation
     * 
     * @test
     */
    public function updateActiveHireConflictsWithReservation()
    {
        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::now()->addDay()->format('Y-m-d');

        $oneWeekFromToday = Carbon::now()->addWeek()->format('Y-m-d');
        $twoWeeksFromToday = Carbon::now()->addDays(14)->format('Y-m-d');

        Reservation::create([
            'start_date' => $oneWeekFromToday,
            'end_date' => $twoWeeksFromToday,
            'vehicle_id' => $this->vehicle->id
        ]);
        $this->assertDatabaseHas('reservations', [
            'start_date' => $oneWeekFromToday,
            'end_date' => $twoWeeksFromToday,
            'vehicle_id' => $this->vehicle->id
        ]);

        $hire = Hire::create([
            'start_date' => $today,
            'end_date' => $tomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);
        $this->assertDatabaseHas('hires', [
            'start_date' => $today,
            'end_date' => $tomorrow,
            'is_active' => true,
            'vehicle_id' => $this->vehicle->id
        ]);
        
        $response = $this->actingAs($this->user)->put(route('admin.hires.update', ['hire' => $hire->name]), [
            'end_date' => $oneWeekFromToday
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('hires', ['reservation', 'end_date']);
        $this->assertDatabaseMissing('hires', [
            'start_date' => $today,
            'end_date' => $oneWeekFromToday,
            'is_active' => true,
            'vehicle_id' => $this->vehicle->id
        ]);
    }

    /**
     * Sends a PUT request to atempt to update an inactive hire 
     * 
     * @test
     */
    public function attemptUpdateOfInactiveHire()
    {
        $today = Carbon::now()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $dayBeforeYesterday = Carbon::yesterday()->subDay()->format('Y-m-d');
        $hire = Hire::create([
            'start_date' => $dayBeforeYesterday,
            'end_date' => $yesterday,
            'vehicle_id' => $this->vehicle->id
        ]);

        $this->assertDatabaseHas('hires', [
            'start_date' => $dayBeforeYesterday,
            'end_date' => $yesterday,
            'is_active' => false,
            'vehicle_id' => $this->vehicle->id
        ]);
        
        $response = $this->actingAs($this->user)->put(route('admin.hires.update', ['hire' => $hire->name]), [
            'start_date' => $dayBeforeYesterday,
            'end_date' => $today
        ]);

        $response->assertStatus(404);
        $this->assertDatabaseMissing('hires', [
            'start_date' => $dayBeforeYesterday,
            'end_date' => $today,
            'is_active' => true,
            'vehicle_id' => $this->vehicle->id
        ]);
    }

    /**
     * Sends a DELETE request to delete an active hire
     * 
     * @test
     */
    public function deleteActiveHire()
    {
        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $hire = Hire::create([
            'start_date' => $today,
            'end_date' => $tomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);

        $this->assertDatabaseHas('hires', [
            'start_date' => $today,
            'end_date' => $tomorrow,
            'is_active' => true,
            'vehicle_id' => $this->vehicle->id
        ]);
        
        $response = $this->actingAs($this->user)->delete(route('admin.hires.destroy', ['hire' => $hire->name]));

        $response->assertStatus(302);
        $response->assertSessionHas('status', [
            'Successfully deleted hire!',
            'ID = '.$hire->name,
            'Vehicle = '.$this->vehicle->full_name,
            'Start Date = '.date('j/M/Y', strtotime($hire->start_date)),
            'End Date = '.date('j/M/Y', strtotime($hire->end_date)),
        ]);
        $this->assertDatabaseMissing('hires', [
            'start_date' => $today,
            'end_date' => $tomorrow,
            'is_active' => true,
            'vehicle_id' => $this->vehicle->id
        ]);
    }

    /**
     * Sends a DELETE request to delete an inactive hire
     * 
     * @test
     */
    public function deleteInactiveHire()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $dayBeforeYesterday = Carbon::yesterday()->subDay()->format('Y-m-d');
        $hire = Hire::create([
            'start_date' => $dayBeforeYesterday,
            'end_date' => $yesterday,
            'vehicle_id' => $this->vehicle->id
        ]);

        $this->assertDatabaseHas('hires', [
            'start_date' => $dayBeforeYesterday,
            'end_date' => $yesterday,
            'is_active' => false,
            'vehicle_id' => $this->vehicle->id
        ]);
        
        $response = $this->actingAs($this->user)->delete(route('admin.hires.destroy', ['hire' => $hire->name]));

        $response->assertStatus(302);
        $response->assertSessionHas('status', [
            'Successfully deleted hire!',
            'ID = '.$hire->name,
            'Vehicle = '.$this->vehicle->full_name,
            'Start Date = '.date('j/M/Y', strtotime($hire->start_date)),
            'End Date = '.date('j/M/Y', strtotime($hire->end_date)),
        ]);
        $this->assertDatabaseMissing('hires', [
            'start_date' => $dayBeforeYesterday,
            'end_date' => $yesterday,
            'is_active' => false,
            'vehicle_id' => $this->vehicle->id
        ]);
    }


}
