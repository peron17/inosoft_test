<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testSuccessLogin()
    {
        $this->prepare();

        $password = 'admin';
        \App\Models\User::factory(1)->create([
            'password' => Hash::make($password)
        ]);

        $model = \App\Models\User::first();

        $body = [
            'email' => $model->email,
            'password' => $password
        ];

        $this->postJson('/api/login', $body, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token'
                ]
            ]);
    }

    /**
     * @dataProvider validationDataProvider
     */
    public function testValidation(array $invalidData, string $invalidParameter)
    {
        $this->artisan('migrate');
        $this->artisan('passport:install');

        $password = 'admin';
        \App\Models\User::factory(1)->create([
            'password' => Hash::make($password)
        ]);

        $model = \App\Models\User::first();

        $validData = [
            'email' => $model->email,
            'password' => $password
        ];

        $body = array_merge($validData, $invalidData);

        $response = $this->postJson('/api/login', $body, ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([$invalidParameter]);
    }

    public function validationDataProvider()
    {
        return [
            [['email' => null], 'email'],
            [['email' => 'example'], 'email'],
            [['email' => 123456], 'email'],
            [['email' => []], 'email'],
            [['email' => 'example@google.com'], 'email'],
            [['password' => null], 'password'],
            [['password' => 123456], 'password'],
            [['password' => []], 'password'],
        ];
    }
}
