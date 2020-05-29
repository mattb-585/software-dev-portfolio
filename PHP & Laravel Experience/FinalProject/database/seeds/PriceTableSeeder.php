<?php

use Illuminate\Database\Seeder;

class PriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $price = new \App\Price([
            'price' => 5.00,
            'product_id' => 1
        ]);
        $price->save();

        $price = new \App\Price([
            'price' => 3.99,
            'product_id' => 1
        ]);
        $price->save();

        $price = new \App\Price([
            'price' => 7.00,
            'product_id' => 2
        ]);
        $price->save();

        $price = new \App\Price([
            'price' => 5.99,
            'product_id' => 2
        ]);
        $price->save();

        $price = new \App\Price([
            'price' => 10.00,
            'product_id' => 3
        ]);
        $price->save();

        $price = new \App\Price([
            'price' => 8.99,
            'product_id' => 3
        ]);
        $price->save();

        $price = new \App\Price([
            'price' => 10.00,
            'product_id' => 4
        ]);
        $price->save();

        $price = new \App\Price([
            'price' => 8.99,
            'product_id' => 4
        ]);
        $price->save();

        $price = new \App\Price([
            'price' => 15.00,
            'product_id' => 5
        ]);
        $price->save();

        $price = new \App\Price([
            'price' => 13.99,
            'product_id' => 5
        ]);
        $price->save();

        $price = new \App\Price([
            'price' => 15.00,
            'product_id' => 6
        ]);
        $price->save();

        $price = new \App\Price([
            'price' => 13.99,
            'product_id' => 6
        ]);
        $price->save();
    }
}
