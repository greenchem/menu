<?php

use Illuminate\Database\Seeder;

// Model
use App\Objects\Menu;
use App\Objects\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_pool = collect([
            ['name' => 'product1', 'unit_type' => 'unit_type1', 'description' => 'test product1'],
            ['name' => 'product2', 'unit_type' => 'unit_type2', 'description' => 'test product2'],
            ['name' => 'product3', 'unit_type' => 'unit_type3', 'description' => 'test product3'],
            ['name' => 'product4', 'unit_type' => 'unit_type4', 'description' => 'test product4'],
            ['name' => 'product5', 'unit_type' => 'unit_type5', 'description' => 'test product5'],
        ]);

        $menu_products = Menu::all()->map(function ($menu, $key) use ($product_pool) {
            return $product_pool->map(function ($product, $key) use ($menu) {
                return array_merge($product, [
                    'menu_id' => $menu->getAttribute('id'),
                    'inventory' => mt_rand(1, 100),
                    'order_qty' => mt_rand(1, 100),
                    'price' => mt_rand(0, 10) * 100 + 99,
                    'description' => $menu->getAttribute('name').'的'.$product['description'],
                ]);
            });
        });

        foreach ($menu_products as $products) {
            foreach ($products as $product) {
                Product::firstOrCreate($product);
            }
        }
    }
}
