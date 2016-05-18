<?php

use Illuminate\Database\Seeder;

// Model
use App\Objects\User;
use App\Objects\Period;
use App\Objects\Menu;
use App\Objects\Product;
use App\Objects\BookingLog;

class BookingLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_period_menu_product_bookingLogs = User::all()->map(function ($user, $key) {
            return Period::all()->map(function ($period, $key) use ($user) {
                $menus = Menu::where('period_id', $period->getAttribute('id'))->where('status', 'visible')->get();

                return $menus->map(function ($menu, $key) use ($user, $period) {
                    $products = Product::where('menu_id', $menu->getAttribute('id'))->get();

                    return $products->map(function ($product, $key) use ($user, $period, $menu) {
                        $number = mt_rand(1, 10);
                        return [
                            'user_id' => $user->getAttribute('id'),
                            'period_id' => $period->getAttribute('id'),
                            'menu_id' => $menu->getAttribute('id'),
                            'product_id' => $product->getAttribute('id'),
                            'number' => $number,
                            'price' => $product->getAttribute('price') * $number,
                            'status' => 'confirmed',
                        ];
                    });
                });
            });
        });

        foreach ($user_period_menu_product_bookingLogs as $period_menu_product_bookingLogs) {
            foreach ($period_menu_product_bookingLogs as $menu_product_bookingLogs) {
                foreach ($menu_product_bookingLogs as $product_bookingLogs) {
                    foreach ($product_bookingLogs as $bookingLog) {
                        BookingLog::firstOrCreate($bookingLog);
                    }
                }
            }
        }
    }
}
