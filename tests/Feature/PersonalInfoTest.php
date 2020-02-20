<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonalInfoTest extends TestCase
{
    /**
     * undocumented function
     *
     * @return void
     */
    private function employeeToken()
    {
        $employee = factory(User::class)->create();
        return $employee->createToken('FeatureTestToken')->accessToken;
    }
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test get all personal info
     *
     * @return void
     */
    public function testGetPersonalInfo()
    {
        $employee = factory(User::class)->create();
        $employee->personal_info()->create([
            'gender' => 1,
            'nric' => '919191919191',
            'nationality' => 'MY',
        ]);

        $token = $employee->createToken('FeatureTestToken')->accessToken;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $cookies = [];

        $response = $this->call(
            'GET',
            'https://demo.local/api/personal_info',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headers),
        );

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'gender',
                    'nric',
                    'nationality'
                ]
            ])
            ->assertJson(['data' => ['nric' => '919191919191']]);
    }

    /**
     * Test create personal info
     *
     * @return void
     */
    public function testStorePersonalInfo()
    {
        $employee = factory(User::class)->create();

        $token = $employee->createToken('FeatureTestToken')->accessToken;

        $headers = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $payloads = [
            'gender' => 1,
            'nric' => '919191919191',
            'nationality' => 'MY',
        ];

        $cookies = [];

        $response = $this->call(
            'POST',
            'https://demo.local/api/personal_info',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headers),
            json_encode($payloads)
        );

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'gender',
                    'nric',
                    'nationality'
                ]
            ])
            ->assertJson(['data' => ['nric' => '919191919191']]);
    }

    /**
     * Test update personal info
     *
     * @return void
     */
    public function testUpdatePersonalInfo()
    {
        $employee = factory(User::class)->create();
        $employee->personal_info()->create();

        $token = $employee->createToken('FeatureTestToken')->accessToken;

        $headers = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $payloads = [
            'gender' => 1,
            'nric' => '919191919191',
            'nationality' => 'MY',
        ];

        $cookies = [];

        $response = $this->call(
            'PATCH',
            'https://demo.local/api/personal_info',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headers),
            json_encode($payloads)
        );

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'gender',
                    'nric',
                    'nationality'
                ]
            ])
            ->assertJson(['data' => ['nric' => '919191919191']]);
    }
    
}
