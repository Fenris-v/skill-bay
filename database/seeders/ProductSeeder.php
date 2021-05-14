<?php

namespace Database\Seeders;

use App\Models\ProductReview;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Attachment;
use Database\Seeders\Traits\ReplicateAttachmentWithoutGenerateImageTrait;

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
        Product::factory([
            'main_image_id' => '',
        ])
            ->count(50)
            ->has(ProductReview::factory()->count(5), 'reviews')
            ->create([
                'main_image_id' => $this->getRandomAttachmentId(),
            ])
            ->each(fn($product) => $product->images()->attach(
                Attachment::create($this->getReplicatedAttachment())
            ))
        ;
    }
}
