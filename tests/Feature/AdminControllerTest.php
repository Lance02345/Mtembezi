<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\BlogRequest;
use App\Models\Post;
use App\Models\User;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get(route('admin.createBlog'));

        $response->assertStatus(200)
            ->assertViewIs('admins.create_blog');
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStore()
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'admin']);
        $image = UploadedFile::fake()->image('image.jpg');

        $response = $this->actingAs($user)->post(route('admin.store'), [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'published_at' => $this->faker->date,
            'image_1' => $image,
        ]);

        $response->assertRedirect(route('admin.myblogs'));
    }

    /**
     * Test myblogs method.
     *
     * @return void
     */
    public function testMyBlogs()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('admin.myblogs'));

        $response->assertStatus(200)
            ->assertViewIs('admins.myblogs')
            ->assertSee($post->title);
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEdit()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.editform', $post->id));

        $response->assertStatus(200)
            ->assertViewIs('admins.edit')
            ->assertSee($post->title);
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'admin']);
        $post = Post::factory()->create(['user_id' => $user->id]);
        $image = UploadedFile::fake()->image('image.jpg');

        $response = $this->actingAs($user)->put(route('admin.update', $post->id), [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'published_at' => $this->faker->date,
            'image_1' => $image,
        ]);

        $response->assertRedirect(route('admin.myblogs'));
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroy()
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'admin']);
        $post = Post::factory()->create(['user_id' => $user->id]);
        $image = UploadedFile::fake()->image('image.jpg');
        $post->image_1 = 'storage/images/image.jpg';
        $post->save();

        $response = $this->actingAs($user)->delete(route('admin.destroy', $post->id));

        $response->assertRedirect(route('admin.myblogs'))
            ->assertSessionHas('success', 'Post deleted successfully');
    }

    // Add more test methods as needed
}
