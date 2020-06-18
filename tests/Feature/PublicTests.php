<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsFormSubmission;
use App\Mail\ContactUsFormReceipt;

class PublicTests extends TestCase
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
     * Sends a GET request to the public home page
     * 
     * @test
     */
    public function getHomePage()
    {
        $response = $this->get(route('public.root'));
        $response->assertStatus(200);
        $response->assertViewIs('public.home');
    }

    /**
     * Sends a GET request to the public vehicles page
     * 
     * @test
     */
    public function getVehiclesPage()
    {
        $response = $this->get(route('public.vehicles'));
        $response->assertStatus(200);
        $response->assertViewIs('public.vehicles');
    }

    /**
     * Sends a GET request to the public contact page
     * 
     * @test
     */
    public function getContactPage()
    {
        $response = $this->get(route('public.contact'));
        $response->assertStatus(200);
        $response->assertViewIs('public.contact');
    }

    /**
     * Sends a GET request to the public xml sitemap
     * 
     * @test
     */
    public function getSitemap()
    {
        $response = $this->get(route('public.siteMap'));
        $response->assertStatus(200);
    }

    /**
     * Sends a GET request to the public login page
     * 
     * @test
     */
    public function getLoginPage()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /**
     * Sends a GET request to the public password reset page
     * 
     * @test
     */
    public function getPasswordResetPage()
    {
        $response = $this->get(route('password.request'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.passwords.email');
    }

    /**
     * Sends a POST request to the public login page
     * 
     * @test
     */
    public function loginAsUser()
    {
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => 'secret'
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * Sends a POST request to the public login page with an incorrect password
     * 
     * @test
     */
    public function loginAsUserBadPassword()
    {
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => $this->faker->randomAscii(8)
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Sends a POST request to the public contact page to send an email
     * 
     * @test
     */
    public function submitContactUsPageForm()
    {
        $email = $this->faker->unique()->safeEmail;

        Mail::fake();
        Mail::assertNothingSent();

        $response = $this->post(route('public.contact'), [
            'name' => $this->faker->name,
            'email' => $email,
            'subject' => $this->faker->sentence,
            'message' => $this->faker->text
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status', [
            'E-Mail sent successfully!',
            'We\'ve sent an E-Mail receipt to ' . $email
        ]);

        $users = User::whereReceivesEmail(true)->get();

        // Assert all users that receive emails were sent an email
        foreach($users as $user) {
            Mail::assertSent(ContactUsFormSubmission::class, function ($mail) use ($user) {
                return $mail->hasTo($user->email);
            });
        }

        // Assert the expected number of emails were sent to users
        Mail::assertSent(ContactUsFormSubmission::class, $users->count());

        // Assert that the initial sender receives an email receipt
        Mail::assertSent(ContactUsFormReceipt::class, function ($mail) use ($email) {
            return $mail->hasTo($email);
        });
    }
}
