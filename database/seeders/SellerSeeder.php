<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\Product;
use Database\Seeders\Traits\ReplicateAttachmentWithoutGenerateImageTrait;
use Illuminate\Support\Collection;

class SellerSeeder extends Seeder
{
    use ReplicateAttachmentWithoutGenerateImageTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $doSeed = function(Collection $products, int $imageId) {
            if ($products->isEmpty()) {
                return null;
            }
            Seller::factory([
                'image_id' => $imageId,
            ])
                ->hasAttached($products, fn() => [
                    'price' => rand(3000, 20000) / 100,
                ])
                ->create();
        };
        for ($i = 0; $i < 10; $i++) {
            if (!$i) {
                $doSeed($products, $this->getRandomAttachmentId());
            } else {
                $productsAmount = $products->count();
                $doSeed(
                    $products->random(rand(floor($productsAmount / 2), $productsAmount)),
                    $this->getRandomAttachmentId()
                );
            }
        }
    }
}
