<?php

namespace Tests\Feature\Http\Controllers;

 use App\Models\User;
 use Illuminate\Foundation\Testing\RefreshDatabase;
 use Illuminate\Foundation\Testing\WithFaker;
 use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_can_login()
    {
        $data = [
            'email' => 'admin@admin.com',
        ];

        User::Factory()->create($data);

        $data['password'] = 'password';

        $response = $this->post($this->routePrefix.'/auth/login', $data);

        $response->assertStatus(200);
    }
}
