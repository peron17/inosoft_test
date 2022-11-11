<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_kendaraan' => \App\Models\Kendaraan::all()->random(),
            'qty' => $this->faker->randomDigitNotZero(),
            'harga' => function ($attributes) {
                return \App\Models\Kendaraan::find($attributes['id_kendaraan'])->harga;
            },
            'total_harga' => function ($attributes) {
                return $attributes['harga'] * $attributes['qty'];
            }
        ];
    }
}
