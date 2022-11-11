<?php

namespace Tests\Feature;

use App\Models\Kendaraan;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesReportTest extends TestCase
{
    public function testForbidUnauthorizedAccess()
    {
        $this->get('api/sales', ['Accept' => 'application/json'])
            ->assertForbidden();
    }

    public function testSuccessfullShowingSalesReport()
    {
        $this->prepare();

        $this->artisan('db:seed');

        $model = \App\Models\User::first();
        $token = $model->createToken('user')->accessToken;

        $this->get('api/sales', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'tgl_transaksi',
                        'nama_pelanggan',
                        'total_harga',
                        'item' => [
                            '*' => [
                                'kendaraan' => [
                                    'id',
                                    'nama_kendaraan',
                                    'jenis_kendaraan',
                                    'tahun_keluaran',
                                    'spesifikasi',
                                ],
                                'qty',
                                'harga',
                                'total_harga',
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
            'start_date' => Order::min('tgl_transaksi'),
            'end_date' => Order::max('tgl_transaksi'),
            'sort_by' => 'tgl_transaksi',
            'sort' => 'desc'
        ];

        $param = array_merge($validParam, $invalidData);

        $response = $this->get('api/sales?' . http_build_query($param), [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([$invalidParameter]);
    }

    public function validationDataProvider()
    {
        return [
            [['start_date' => '10-10-2000'], 'start_date'],
            [['start_date' => 'example'], 'start_date'],
            [['start_date' => 123456], 'start_date'],
            [['start_date' => '2000-01-01 10:00'], 'start_date'],
            [['start_date' => ['2000-01-01']], 'start_date'],
            [['end_date' => '10-10-2000'], 'end_date'],
            [['end_date' => 'example'], 'end_date'],
            [['end_date' => 123456], 'end_date'],
            [['end_date' => '2000-01-01 10:00'], 'end_date'],
            [['end_date' => ['2000-01-01']], 'end_date'],
            [['sort_by' => 'example'], 'sort_by'],
            [['sort_by' => ['example']], 'sort_by'],
            [['sort' => 'example'], 'sort'],
            [['sort' => ['example']], 'sort'],
        ];
    }
}
