<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;
use Auth;

class AuthTest extends TestCase
{

    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::first();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::first();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'admin@admin.com',
        ]);

//        $response->assertRedirect('/home');
        $this->assertTrue(Auth::check());
        $this->actingAs($user);
    }

    // Login Check
//    public function test_user_can_login_with_correct_credentials_via_browser()
//    {
//        $this->browse(function ($browser) {
//            $browser->visit('/login')
//                ->type('email', 'client@app.com')
//                ->type('password', 'password')
//                ->press('Login')
//                ->assertPathIs('/dashboard');
//        });
//    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = User::first();

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_a_user_can_register()
    {
        $user = [
            'name' => 'test'.rand(0, 50),
            'user_name' => 'testuser'.rand(0, 50),
            'email' => 'test'.rand(0, 50).'@admin.com',
            'mobile' => '01011'.rand(0, 50).'6241',
            'password'=> 'admin@admin.com',
            'password_confirmation' => 'admin@admin.com',
            'type' => 'crm admin',
            'code' => uniqid(),
            'status' => 1
        ];

        $response = $this->post('/register', $user, [
            "XSRF-TOKEN" => csrf_token(),
            "_token"    => csrf_token()
        ]);
        unset($user['password_confirmation']);
        unset($user['code']);
        unset($user['password']);
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', $user);
    }

    public function test_can_a_user_logout()
    {
        $user = User::first();
        $this->be($user);
        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();

    }

}
