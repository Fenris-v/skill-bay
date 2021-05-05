<?php

namespace Database\Seeders;

use App\Models\HistoryView;
use App\Models\Product;
use App\Models\User;
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
        $users = User::get('id')->pluck('id')->toArray();

        $products = Product::get('id')->pluck('id')->toArray();
        foreach ($users as $user) {
            $productsTemp = $products;
            for ($i = 0; $i < 20; $i++) {
                if (empty($productsTemp)) {
                    break;
                }

                shuffle($productsTemp);
                $product = array_shift($productsTemp);

                HistoryView::create(
                    [
                        'product_id' => $product,
                        'user_id' => $user,
                        'created_at' => now()->subDays(rand(31, 60)),
                        'updated_at' => now()->subDays(rand(1, 30))
                    ]
                );
            }
        }
    }
}
