<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;
use Auth;

class AuthAPITest extends TestCase
{
    protected $user;
    protected $password;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::first();
        $this->password = 'admin@admin.com';
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $response = $this->post('/api/auth/login', [
            'email' => $this->user->email,
            'password' => 'admin@admin.com',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'token',
                'token_type',
                'expires_in',
                'user' => [
                    "id",
                    "name",
                    "user_name",
                    "email",
                    "mobile",
                    "email_verified_at",
                    "status",
                    "code",
                    "type",
                    "language",
                    "created_at",
                    "updated_at",
                    "deleted_at",
                    "banned_until",
                    "freeze"
                ]
            ]);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $response = $this->from('/api/auth/login')->post('/api/auth/login', [
            'email' => $this->user->email,
            'password' => 'invalid-password',
        ]);

        $response
            ->assertStatus(401)
            ->assertJson([
                'error' => "Unauthorized",
            ]);
    }

    public function testLogout()
    {
        $token = JWTAuth::fromUser($this->user);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/auth/logout');
        $response->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertGuest('api');
    }

    public function test_refresh()
    {
        $token = JWTAuth::fromUser($this->user);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/auth/refresh');
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'token',
                'token_type',
                'expires_in',
                'user'
            ]);
    }
    public function test_retrieve_authed_user_data()
    {
        $token = JWTAuth::fromUser($this->user);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post('api/auth/me');
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    "id",
                    "name",
                    "user_name",
                    "email",
                    "mobile",
                    "status",
                    "code",
                    "type",
                    "language",
                    "banned_until",
                    "freeze",
                    "role_id",
                    "role_name",
                    "permissions",
                ]
            ]);
    }
}
