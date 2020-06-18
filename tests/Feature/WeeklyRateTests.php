<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\WeeklyRate;

class WeeklyRateTests extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->weekly_rate = null;
        $this->user = factory(User::class)->create();
    }

    public function tearDown(): void
    {
        $this->user->delete();
        if (!is_null($this->weekly_rate)) {
            $this->weekly_rate->delete();
            $this->weekly_rate = null;
        }
        $this->flushSession();
        parent::tearDown();
    }

    /**
     * Sends a GET request to the admin weekly rates page
     * 
     * @test
     */
    public function getWeeklyRatesPage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.weekly-rates.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.admin-weekly-rates');
    }

    /**
     * Sends a GET request to the admin weekly rates creation page
     * 
     * @test
     */
    public function getWeeklyRateCreationPage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.weekly-rates.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.weekly-rate.create');
    }

    /**
     * Sends a GET request to the admin weekly rate edit page
     * 
     * @test
     */
    public function getWeeklyRateEditPage()
    {
        $this->weekly_rate = WeeklyRate::create([
            'name' => 'test_weekly_rate',
            'weekly_rate_min' => 50,
            'weekly_rate_max' => 100
        ]);
        $response = $this->actingAs($this->user)->get(route('admin.weekly-rates.edit', ['weekly_rate' => $this->weekly_rate->slug]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.weekly-rate.edit');
    }

    /**
     * Sends a POST request to create a weekly rate with valid attributes
     * 
     * @test
     */
    public function createWeeklyRateWithValidAttributes()
    {
        $data = [
            'name' => 'test_weekly_rate',
            'weekly_rate_min' => 50,
            'weekly_rate_max' => 100
        ];
        $response = $this->actingAs($this->user)->post(route('admin.weekly-rates.store'), $data);

        $this->weekly_rate = WeeklyRate::where($data)->get()->first();

        $response->assertStatus(302);
        $response->assertSessionHas('status.weekly_rate', 'Successfully created weekly rate!');
        $this->assertDatabaseHas('weekly_rates', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Sends a POST request to create a weekly rate with invalid attributes
     * 
     * @test
     */
    public function createWeeklyRateWithInvalidAttributes()
    {
        $data = [
            'name' => null,
            'weekly_rate_min' => 50,
            'weekly_rate_max' => 100
        ];
        $response = $this->actingAs($this->user)->post(route('admin.weekly-rates.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseMissing('weekly_rates', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Sends a POST request to create a weekly rate that already exists
     * 
     * @test
     */
    public function createWeeklyRateThatAlreadyExists()
    {
        $data = [
            'name' => 'test_weekly_rate',
            'weekly_rate_min' => 50,
            'weekly_rate_max' => 100
        ];
        $this->weekly_rate = WeeklyRate::create($data);

        $response = $this->actingAs($this->user)->post(route('admin.weekly-rates.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseHas('weekly_rates', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Sends a PUT request to create a weekly rate with valid attributes
     * 
     * @test
     */
    public function updateWeeklyRateWithValidAttributes()
    {
        $this->weekly_rate = WeeklyRate::create([
            'name' => 'test_weekly_rate',
            'weekly_rate_min' => 50,
            'weekly_rate_max' => 100
        ]);
        $response = $this->actingAs($this->user)->put(route('admin.weekly-rates.update', ['weekly_rate' => $this->weekly_rate->slug]), [
            'name' => 'test_weekly_rate_new',
            'weekly_rate_min' => 50,
            'weekly_rate_max' => 100
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status.weekly_rate', 'Successfully updated weekly rate!');
        $this->assertDatabaseHas('weekly_rates', [
            'name' => 'test_weekly_rate_new',
        ]);
    }

    /**
     * Sends a PUT request to update a weekly rate with invalid attributes
     * 
     * @test
     */
    public function updateWeeklyRateWithInvalidAttributes()
    {
        $this->weekly_rate = WeeklyRate::create([
            'name' => 'test_weekly_rate',
            'weekly_rate_min' => 50,
            'weekly_rate_max' => 100
        ]);
        $response = $this->actingAs($this->user)->put(route('admin.weekly-rates.update', ['weekly_rate' => $this->weekly_rate->slug]), [
            'name' => null,
            'weekly_rate_min' => null,
            'weekly_rate_max' => null
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'weekly_rate_min', 'weekly_rate_max']);
        $this->assertDatabaseMissing('weekly_rates', [
            'name' => null,
        ]);
    }

    /**
     * Sends a PUT request to update a weekly rate with a name 
     * that is already assigned to another weekly rate
     * 
     * @test
     */
    public function updateWeeklyRateThatAlreadyExists()
    {
        $this->weekly_rate = WeeklyRate::create([
            'name' => 'test_weekly_rate',
            'weekly_rate_min' => 50,
            'weekly_rate_max' => 100
        ]);
        $other_weekly_rate = WeeklyRate::create([
            'name' => 'test_other_weekly_rate',
            'weekly_rate_min' => 50,
            'weekly_rate_max' => 100
        ]);
        
        $response = $this->actingAs($this->user)->put(route('admin.weekly-rates.update', ['weekly_rate' => $this->weekly_rate->slug]), [
            'name' => 'test_other_weekly_rate'
        ]);

        $other_weekly_rate->delete();
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseHas('weekly_rates', [
            'name' => 'test_weekly_rate',
        ]);
    }

    /**
     * Sends a DELETE request to delete a weekly rate 
     * 
     * @test
     */
    public function deleteWeeklyRate()
    {
        $this->weekly_rate = WeeklyRate::create([
            'name' => 'test_weekly_rate',
            'weekly_rate_min' => 50,
            'weekly_rate_max' => 100
        ]);
        
        $response = $this->actingAs($this->user)->delete(route('admin.weekly-rates.destroy', ['weekly_rate' => $this->weekly_rate->slug]));

        $response->assertStatus(302);
        $response->assertSessionHas('status.weekly_rate', 'Successfully deleted weekly rate!');
        $this->assertDatabaseMissing('weekly_rates', [
            'name' => 'test_weekly_rate',
        ]);
    }
}
