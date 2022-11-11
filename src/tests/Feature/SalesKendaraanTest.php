<?php

namespace Tests\Feature;

use App\Models\Kendaraan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SalesKendaraanTest extends TestCase
{
    public function testForbidUnauthorizedAccess()
    {
        $this->get('api/sales-kendaraan', ['Accept' => 'application/json'])
            ->assertForbidden();
    }

    public function testSuccessfullShowingSalesKendaraanReportWithoutId()
    {
        $this->prepare();

        $this->artisan('db:seed');

        $model = \App\Models\User::first();
        $token = $model->createToken('user')->accessToken;

        $this->get('api/sales-kendaraan', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'kendaraan' => [
                            'id',
                            'nama_kendaraan',
                            'jenis_kendaraan',
                            'tahun_keluaran',
                            'spesifikasi',
                        ],
                        'sales' => [
                            '*' => [
                                'qty',
                                'harga',
                                'total_harga',
                                'order' => [
                                    'id',
                                    'tgl_transaksi',
                                    'nama_pelanggan',
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
    }

    public function testSuccessfullShowingSalesKendaraanReportWithId()
    {
        $this->prepare();

        $this->artisan('db:seed');

        $model = \App\Models\User::first();
        $token = $model->createToken('user')->accessToken;

        $this->get('api/sales-kendaraan/' . Kendaraan::first()->id, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'kendaraan' => [
                            'id',
                            'nama_kendaraan',
                            'jenis_kendaraan',
                            'tahun_keluaran',
                            'spesifikasi',
                        ],
                        'sales' => [
                            '*' => [
                                'qty',
                                'harga',
                                'total_harga',
                                'order' => [
                                    'id',
                                    'tgl_transaksi',
                                    'nama_pelanggan',
                                ]
                            ]
                        ]
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

        $this->artisan('db:seed');

        $model = \App\Models\User::first();
        $token = $model->createToken('user')->accessToken;

        $validParam = [
            'jenis_kendaraan' => 'mobil'
        ];

        $param = array_merge($validParam, $invalidData);

        $response = $this->get('api/sales-kendaraan?' . http_build_query($param), [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([$invalidParameter]);
    }

    public function validationDataProvider()
    {
        return [
            [['jenis_kendaraan' => 'MOBIL'], 'jenis_kendaraan'],
            [['jenis_kendaraan' => 123456], 'jenis_kendaraan'],
            [['jenis_kendaraan' => ['mobil']], 'jenis_kendaraan'],
        ];
    }
}
