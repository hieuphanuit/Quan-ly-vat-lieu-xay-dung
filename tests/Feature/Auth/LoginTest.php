<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginSuccessTest()
    {
        $this->json('post', '/api/auth/login', [
                'email' => 'hieuminh@gmail.com',
                'password' => '123',
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'user',
                'token',
                'expires_in'
            ]);
    }

    public function testLoginFailTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $this->json('post', '/api/auth/login', [
                'email' => 'hieuminh@gmail.com',
                'password' => '12345',
            ])
            ->assertStatus(401)
            ->assertJson([
                'error' => 'Unauthorized',
            ]);
    }

    public function testLoginInvalidDataTest()
    {
        $this->json('post', '/api/auth/login', [
                'email' => 'hieuminh@gmail.com',
            ])
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors'
            ]);
    }

}
