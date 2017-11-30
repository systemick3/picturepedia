<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\User as User;

class UploadTest extends TestCase
{
    /**
     * Test authentication on upload routes.
     *
     * @return void
     */
    public function testUploadAuthentication()
    {
        $guardedUrls = ['/upload'];
        foreach ($guardedUrls as $url) {
            $response = $this->get($url);
            $response->assertStatus(302);
            $response->assertRedirect('/login');

            $user = factory(User::class)->create();

            $response = $this->actingAs($user)
                ->get($url);
            $response->assertStatus(200);
            $response->assertViewIs('images.upload');
        }
    }

    /**
     * Test uploaded file is stored on file system.
     *
     * @return void
     */
    /*public function testUploadFileIsStored()
    {
        Storage::fake('public');

        $response = $this->post('/upload', [
            'image' => UploadedFile::fake()->image('picture.jpg')
        ]);

        // Assert the file was stored...
        Storage::disk('public')->assertExists('storage/images/picture.jpg');

        // Assert a file does not exist...
        Storage::disk('public')->assertMissing('storage/images/missing.jpg');
    }*/
}
