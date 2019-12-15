<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicNavigationTest extends TestCase
{
    public function testHome()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testVehicles()
    {
        $response = $this->get('/vehicles');
        $response->assertStatus(200);
    }

    public function testContact()
    {
        $response = $this->get('/contact-us');
        $response->assertStatus(200);
    }
}
