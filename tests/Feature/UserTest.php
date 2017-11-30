<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    //use RefreshDatabase;

    const USERNAME_INVALID = 'qerfqefqe';
    const USERNAME_WITH_IMAGES = 'systemick';
    const USERNAME_WITHOUT_IMAGES = 'user_1';

    /**
     * Test a profile page for an invalid user returns a 404.
     *
     * @return void
     */
    public function testInvalidUserProfilePage()
    {
        $response = $this->get('/' . UserTest::USERNAME_INVALID);
        $response->assertStatus(404);
    }

    /**
     * Test an empty profile page.
     *
     * @return void
     */
    public function testEmptyProfilePage()
    {
        $this->assertDatabaseHas('users', [
            'name' => UserTest::USERNAME_WITHOUT_IMAGES,
        ]);

        $response = $this->get('/' . UserTest::USERNAME_WITHOUT_IMAGES);
        $response->assertStatus(200);
        $response->assertViewIs('user.profile');
        $response->assertDontSeeText('Profile for systemick.');
        $response->assertSeeText('Profile for user_1.');
        $response->assertSeeText('This user hasn\'t added any images yet.');
    }

    /**
     * Test a profile page with images.
     *
     * @return void
     */
    public function testProfilePageHasImages()
    {
        $this->assertDatabaseHas('users', [
            'email' => 'michaelgarthwaite@gmail.com'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => UserTest::USERNAME_WITH_IMAGES
        ]);

        $response = $this->get('/' . UserTest::USERNAME_WITH_IMAGES);
        $response->assertStatus(200);
        $response->assertViewIs('user.profile');
        $response->assertSeeText('Profile for systemick.');
    }


}
