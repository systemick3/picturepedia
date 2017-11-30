<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FrontTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFront()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('front');
        $response->assertSee('Front content goes here.');
        $response->assertSeeText('Front content goes here.');
    }
}
