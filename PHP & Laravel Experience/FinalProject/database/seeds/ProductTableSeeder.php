<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
            'image' => 'mug.jpg',
            'name' => 'Coffee Mug'
        ]);
        $product->save();

        $product = new \App\Product([
            'image' => 'travel-mug.jpg',
            'name' => 'Travel Mug'
        ]);
        $product->save();

        $product = new \App\Product([
            'image' => 'polo-shirt.jpg',
            'name' => "Men's Polo Shirt"
        ]);
        $product->save();

        $product = new \App\Product([
            'image' => 'polo-shirt.jpg',
            'name' => "Women's Polo Shirt"
        ]);
        $product->save();

        $product = new \App\Product([
            'image' => 'longsleeve.jpg',
            'name' => "Men's Longsleeve Shirt"
        ]);
        $product->save();

        $product = new \App\Product([
            'image' => 'longsleeve.jpg',
            'name' => "Women's Longsleeve Shirt"
        ]);
        $product->save();
    }
}
