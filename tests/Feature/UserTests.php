<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTests extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function tearDown(): void
    {
        $this->user->delete();
        $this->flushSession();
        parent::tearDown();
    }

    /**
     * Sends a GET request to the admin user edit page
     * 
     * @test
     */
    public function getUserEditPage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.users.edit'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.user.edit');
    }

    /**
     * Sends a GET request to the admin user edit password page
     * 
     * @test
     */
    public function getUserEditPasswordPage()
    {
        $response = $this->actingAs($this->user)->get(route('admin.users.edit-password'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.user.edit-password');
    }

    /**
     * Sends a PATCH request to update current user information
     * 
     * @test
     */
    public function updateUserInfo()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'receives_email' => false,
            'password' => 'secret'
        ];

        $response = $this->actingAs($this->user)->patch(route('admin.users.update'), $data);

        $response->assertStatus(302);
        $response->assertSessionHas('status', [
            'Successfully updated user \'' . $this->user->name . '\'!'
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => $data['name'],
            'email' => $data['email']
        ]);
    }

    /**
     * Sends a PATCH request to update current user password
     * 
     * @test
     */
    public function updateUserPassword()
    {
        $data = [
            'current_password' => 'secret',
            'new_password' => 'secret123',
            'new_password_confirmation' => 'secret123'
        ];

        $response = $this->actingAs($this->user)->patch(route('admin.users.update-password'), $data);

        $response->assertStatus(302);
        $response->assertSessionHas('status', [
            'Successfully updated password!'
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email
        ]);
    }

    /**
     * Sends a PATCH request to update current user password with no password confirmation
     * 
     * @test
     */
    public function updateUserPasswordNoConfirmation()
    {
        $data = [
            'current_password' => 'secret',
            'new_password' => 'secret123',
        ];

        $response = $this->actingAs($this->user)->patch(route('admin.users.update-password'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('default', ['new_password']);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email
        ]);
    }
}
