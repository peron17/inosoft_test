<?php

namespace Tests\Feature;

use App\Models\Kendaraan;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class StockReportTest extends TestCase
{
    public function testForbidUnauthorizedAccess()
    {
        $this->get('api/stock', ['Accept' => 'application/json'])
            ->assertForbidden();
    }

    public function testSuccessfullShowingStockReport()
    {
        $this->prepare();

        Kendaraan::factory(10)->create();

        $password = 'admin';
        \App\Models\User::factory(1)->create([
            'password' => Hash::make($password)
        ]);
        $model = \App\Models\User::first();
        $token = $model->createToken('user')->accessToken;

        $this->get('api/stock', [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'nama_kendaraan',
                        'jenis_kendaraan',
                        'harga',
                        'stok',
                        'total_harga'
                    ]
                ]
            ]);
    }

    /**
     * @dataProvider validationDataProvider
     */
    public function testValidation(array $invalidData, string $invalidParameter)
    {
        $this->prepare();

        Kendaraan::factory(10)->create();

        $password = 'admin';
        \App\Models\User::factory(1)->create([
            'password' => Hash::make($password)
        ]);

        $model = \App\Models\User::first();
        $token = $model->createToken('user')->accessToken;

        $validParam = [
            'nama_kendaraan' => Kendaraan::first()->nama_kendaraan,
            'jenis_kendaraan' => 'mobil'
        ];

        $param = array_merge($validParam, $invalidData);

        $response = $this->get('api/stock?' . http_build_query($param), [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([$invalidParameter]);
    }

    public function validationDataProvider()
    {
        return [
            [['nama_kendaraan' => ['example']], 'nama_kendaraan'],
            [['jenis_kendaraan' => 'MOBIL'], 'jenis_kendaraan'],
            [['jenis_kendaraan' => 123456], 'jenis_kendaraan'],
            [['jenis_kendaraan' => ['mobil']], 'jenis_kendaraan'],
        ];
    }
}
