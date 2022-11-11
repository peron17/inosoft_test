<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tgl_transaksi' => $this->faker->date(),
            'nama_pelanggan' => $this->faker->name()
        ];
    }
}
