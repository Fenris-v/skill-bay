<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductReview;
use Database\Seeders\Traits\ReplicateAttachmentWithoutGenerateImageTrait;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use ReplicateAttachmentWithoutGenerateImageTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->count(50)
            ->has(ProductReview::factory()->count(5), 'reviews')
            ->create(['main_image_id' => $this->getRandomAttachmentId()])
            ->each(
                fn($product) => $product->images()->saveMany(
                    [$this->getReplicatedAttachment(), $this->getReplicatedAttachment()]
                )
            );
    }
}
