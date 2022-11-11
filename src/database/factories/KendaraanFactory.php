<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tahun_keluaran' => $this->faker->year(),
            'warna' => $this->faker->colorName(),
            'harga' => $this->faker->numberBetween(10000, 30000),
            'jenis_kendaraan' => $this->faker->randomElement(['motor', 'mobil']),
            'nama_kendaraan' => $this->faker->streetName(),
            'spesifikasi' => function ($attributes) {
                if ($attributes['jenis_kendaraan'] == 'mobil') {
                    return json_encode([
                        'mesin' => $this->faker->numberBetween(1000, 2500) . 'cc',
                        'kapasitas_penumpang' => $this->faker->numberBetween(2, 7),
                        'tipe' => $this->faker->randomElement(['sedan', 'mpv', 'suv', 'minibus'])
                    ]);
                } else {
                    return json_encode([
                        'mesin' => $this->faker->numberBetween(110, 155) . 'cc',
                        'tipe_suspensi' => $this->faker->randomElement(['Pararel Fork', 'Plunger Rear Suspension', 'Telescopic Fork']),
                        'tipe_transmisi' => $this->faker->randomElement(['manual', 'matic'])
                    ]);
                }
            },
            'stok' => $this->faker->randomDigitNotZero()
        ];
    }
}
