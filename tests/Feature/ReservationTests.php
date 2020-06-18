<?php

namespace Tests\Feature;

use App\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Vehicle;
use Carbon\Carbon;

/**
 * @property mixed user
 * @property mixed vehicle
 */
class ReservationTests extends TestCase
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
     * Sends a GET request to a specific reservation edit page
     * 
     * @test
     */
    public function getReservationEditPage()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $oneWeekFromTomorrow = Carbon::tomorrow()->addWeek()->format('Y-m-d');
        $reservation = Reservation::create([
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);

        $this->assertDatabaseHas('reservations', [
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.reservations.edit', ['reservation' => $reservation->name]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.reservation.edit');
    }
    
    /**
     * Sends a POST request to book a reservation with valid dates
     * 
     * @test
     */
    public function bookReservationWithValidDates()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $oneWeekFromTomorrow = Carbon::tomorrow()->addWeek()->format('Y-m-d');
        $response = $this->actingAs($this->user)->post(route('admin.reservations.store'), [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status.reservation', 'Successfully booked reservation!');
        $this->assertDatabaseHas('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow
        ]);
    }

    /**
     * Sends a POST request to book a reservation with invalid dates
     * 
     * @test
     */
    public function bookReservationWithInvalidDates()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');
        $response = $this->actingAs($this->user)->post(route('admin.reservations.store'), [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $yesterday,
            'end_date' => $today
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('reservations', ['start_date']);
        $this->assertDatabaseMissing('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $yesterday,
            'end_date' => $today
        ]);
    }

    /**
     * Sends a POST request to book an reservation with no dates supplied
     * 
     * @test
     */
    public function bookReservationWithNoDates()
    {
        $response = $this->actingAs($this->user)->post(route('admin.reservations.store'), [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => null,
            'end_date' => null
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('reservations', ['start_date', 'end_date']);
        $this->assertDatabaseMissing('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => null,
            'end_date' => null
        ]);
    }

    /**
     * Sends a POST request to book an reservation with no vehicle id supplied
     * 
     * @test
     */
    public function bookReservationWithNoVehicleId()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $oneWeekFromTomorrow = Carbon::tomorrow()->addWeek()->format('Y-m-d');
        $response = $this->actingAs($this->user)->post(route('admin.reservations.store'), [
            'vehicle_id' => null,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('reservations', ['vehicle_id']);
        $this->assertDatabaseMissing('reservations', [
            'vehicle_id' => null,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow
        ]);
    }

    /**
     * Sends a POST request to book an reservation which conflicts with another reservation
     * 
     * @test
     */
    public function bookReservationConflictsWithOtherReservation()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $oneWeekFromTomorrow = Carbon::tomorrow()->addWeek()->format('Y-m-d');

        // First request
        $response = $this->actingAs($this->user)->post(route('admin.reservations.store'), [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status.reservation', 'Successfully booked reservation!');
        $this->assertDatabaseHas('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow
        ]);

        // Second request
        $response = $this->actingAs($this->user)->post(route('admin.reservations.store'), [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('reservations', ['reservation', 'start_date', 'end_date']);
    }

    /**
     * Sends a POST request to book an reservation which conflicts with a hire
     * 
     * @test
     */
    public function bookReservationConflictsWithHire()
    {
        $today = Carbon::now()->format('Y-m-d');
        $oneWeekFromToday = Carbon::now()->addWeek()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $oneWeekFromTomorrow = Carbon::tomorrow()->addWeek()->format('Y-m-d');

        // First request
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
            'end_date' => $oneWeekFromToday
        ]);

        // Second request
        $response = $this->actingAs($this->user)->post(route('admin.reservations.store'), [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('reservations', ['hire', 'start_date']);
        $this->assertDatabaseMissing('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow
        ]);
    }

    /**
     * Sends a PUT request to update a specific reservation
     * 
     * @test
     */
    public function updateReservation()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $oneWeekFromTomorrow = Carbon::tomorrow()->addWeek()->format('Y-m-d');
        $oneWeekFromToday = Carbon::now()->addWeek()->format('Y-m-d');
        $reservation = Reservation::create([
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);

        $this->assertDatabaseHas('reservations', [
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);

        $response = $this->actingAs($this->user)->put(route('admin.reservations.update', ['reservation' => $reservation->name]), [
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromToday
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status.reservation', 'Successfully updated reservation!');
        $this->assertDatabaseHas('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromToday
        ]);
    }

     /**
     * Sends a PUT request to update a specific reservation to a hire
     * 
     * @test
     */
    public function updateReservationToHire()
    {
        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $oneWeekFromTomorrow = Carbon::tomorrow()->addWeek()->format('Y-m-d');
        $reservation = Reservation::create([
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);

        $this->assertDatabaseHas('reservations', [
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);

        $response = $this->actingAs($this->user)->put(route('admin.reservations.update', ['reservation' => $reservation->name]), [
            'start_date' => $today,
            'end_date' => $oneWeekFromTomorrow
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status.reservation', 'Successfully updated reservation! (converted to hire)');
        $this->assertDatabaseMissing('reservations', [
            'start_date' => $today,
            'end_date' => $oneWeekFromTomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);
        $this->assertDatabaseHas('hires', [
            'start_date' => $today,
            'end_date' => $oneWeekFromTomorrow,
            'is_active' => true,
            'vehicle_id' => $this->vehicle->id
        ]);
    }

    /**
     * Sends a PUT request to update a reservation which conflicts with another reservation
     * 
     * @test
     */
    public function updateReservationConflictsWithOtherReservation()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $oneWeekFromTomorrow = Carbon::tomorrow()->addWeek()->format('Y-m-d');

        $twoWeeksFromToday = Carbon::now()->addDays(14)->format('Y-m-d');
        $threeWeeksFromToday = Carbon::now()->addDays(21)->format('Y-m-d');

        // First reservation
        Reservation::create([
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);
        $this->assertDatabaseHas('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow
        ]);

        // Second reservation
        $second_reservation = Reservation::create([
            'start_date' => $twoWeeksFromToday,
            'end_date' => $threeWeeksFromToday,
            'vehicle_id' => $this->vehicle->id
        ]);
        $this->assertDatabaseHas('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $twoWeeksFromToday,
            'end_date' => $threeWeeksFromToday
        ]);

        // Update request
        $response = $this->actingAs($this->user)->put(route('admin.reservations.update', ['reservation' => $second_reservation->name]), [
            'start_date' => $oneWeekFromTomorrow,
            'end_date' => $threeWeeksFromToday
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('reservations', ['reservation', 'start_date']);
        $this->assertDatabaseMissing('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $oneWeekFromTomorrow,
            'end_date' => $threeWeeksFromToday
        ]);
    }

    /**
     * Sends a PUT request to update a reservation which conflicts with the active hire
     * 
     * @test
     */
    public function updateReservationConflictsWithActiveHire()
    {
        $today = Carbon::now()->format('Y-m-d');
        $oneWeekFromTomorrow = Carbon::tomorrow()->addWeek()->format('Y-m-d');

        $twoWeeksFromToday = Carbon::now()->addDays(14)->format('Y-m-d');
        $threeWeeksFromToday = Carbon::now()->addDays(21)->format('Y-m-d');

        // Active hire
        Reservation::create([
            'start_date' => $today,
            'end_date' => $oneWeekFromTomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);
        $this->assertDatabaseHas('hires', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $today,
            'end_date' => $oneWeekFromTomorrow
        ]);

        // Reservation
        $reservation = Reservation::create([
            'start_date' => $twoWeeksFromToday,
            'end_date' => $threeWeeksFromToday,
            'vehicle_id' => $this->vehicle->id
        ]);
        $this->assertDatabaseHas('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $twoWeeksFromToday,
            'end_date' => $threeWeeksFromToday
        ]);

        // Update request
        $response = $this->actingAs($this->user)->put(route('admin.reservations.update', ['reservation' => $reservation->name]), [
            'start_date' => $oneWeekFromTomorrow,
            'end_date' => $threeWeeksFromToday
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('reservations', ['hire', 'start_date']);
        $this->assertDatabaseMissing('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $oneWeekFromTomorrow,
            'end_date' => $threeWeeksFromToday
        ]);
    }

    /**
     * Sends a DELETE request to delete a reservation
     * 
     * @test
     */
    public function deleteReservation()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $oneWeekFromTomorrow = Carbon::tomorrow()->addWeek()->format('Y-m-d');

        $reservation = Reservation::create([
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow,
            'vehicle_id' => $this->vehicle->id
        ]);
        $this->assertDatabaseHas('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.reservations.destroy', ['reservation' => $reservation->name]));

        $response->assertStatus(302);
        $response->assertSessionHas('status.reservation', 'Successfully cancelled reservation!');
        $this->assertDatabaseMissing('reservations', [
            'vehicle_id' => $this->vehicle->id,
            'start_date' => $tomorrow,
            'end_date' => $oneWeekFromTomorrow
        ]);
    }
}
