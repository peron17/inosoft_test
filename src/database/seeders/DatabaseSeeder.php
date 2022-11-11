<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->state(['password' => Hash::make('admin')])->create();

        \App\Models\Kendaraan::factory(20)->create();

        $orders = \App\Models\Order::factory()->count(20)->create()->each(function (\App\Models\Order $orders) {
            \App\Models\OrderItem::factory()->count(4)->state([
                'id_order' => $orders->id
            ])->create();
        });

        foreach ($orders as $order) {
            $items = \App\Models\OrderItem::where('id_order', $order->id)->sum('total_harga');
            $order->total_harga = $items;
            $order->save();
        }
    }
}
