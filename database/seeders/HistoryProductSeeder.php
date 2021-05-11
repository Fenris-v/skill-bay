<?php

namespace Database\Seeders;

use App\Models\HistoryView;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Database\Seeder;

class HistoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get('id')->pluck('id');
        $products = Product::get('id')->pluck('id');

        $doSeed = function (int $amount, int $user, array $products) {
            for ($i = 0; $i < $amount; $i++) {
                if (empty($products)) {
                    break;
                }
                shuffle($products);

                HistoryView::create(
                    [
                        'product_id' => array_shift($products),
                        'user_id' => $user,
                        'created_at' => now()->subDays(rand(31, 60)),
                        'updated_at' => now()->subDays(rand(1, 30))
                    ]
                );
            }
        };

        $doSeed(20, $users[0], $products->toArray());
        $doSeed(10, $users[1], $products->toArray());
        $doSeed(5, $users[2], $products->toArray());
    }
}
