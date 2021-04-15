<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_is_created_when_they_register()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson('/register', [
            'name' => 'Joseph Hand',
            'email' => 'joseph.hand@example.com',
            'password' => 'secretPass',
            'password_confirmation' => 'secretPass'
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'Joseph Hand',
            'email' => 'joseph.hand@example.com'
        ]);
    }

    /** @test */
    public function only_an_authenticated_user_can_see_home_view()
    {

        $this->getJson('home')
             ->assertStatus(401);

        $user = \App\Models\User::factory()->create();

        $this->actingAs($user)
             ->getJson('home')
             ->assertOk();
    }

    /** @test */
    public function admin_can_see_celebs_create_view()
    {
        $admin = \App\Models\User::factory()->create([
            'is_admin' => true
        ]);

        $this->actingAs($admin)
            ->getJson('celebs/create')
            ->assertOk();
    }

    /** @test */
    public function normal_user_cannot_see_celebs_create_view()
    {
        $user = \App\Models\User::factory()->create([
            'is_admin' => false
        ]);

        $this->actingAs($user)
             ->getJson('celebs/create')
             ->assertStatus(403);
    }

    /** @test */
    public function guest_cannot_see_celebs_create_view()
    {
        $this->getJson('celebs/create')
            ->assertStatus(403);
    }
}