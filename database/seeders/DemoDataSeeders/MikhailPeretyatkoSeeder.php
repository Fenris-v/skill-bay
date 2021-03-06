<?php

namespace Database\Seeders\DemoDataSeeders;

use App\Models\Attachment;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountUnit;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Specification;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Support\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Hash;
use File;

class MikhailPeretyatkoSeeder extends Seeder
{
    const STORAGE = 'storage/app/public/';

    public string $path;
    public string $fullPath;

    public function __construct()
    {
        $year = (string) now()->year;

        $month = (string) now()->month;
        if (\Str::length($month) === 1) {
            $month = "0$month";
        }

        $day = (string)now()->day;
        if (Str::length($day) === 1) {
            $day = "0$day";
        }

        $this->path = "$year/$month/$day/";

        $this->fullPath = self::STORAGE . $this->path;
    }

    public function run()
    {
        $user = $this->makeUser();

        $this->makeSellers();

        $this->makeCategories();

        $this->makeSpecifications();

        $sellers = Seller::whereIn(
            'slug',
            [
                'game-console-store',
                'console-slave',
                'gamer-shop',
            ]
        )->get();

        $categories = Category::whereIn(
            'slug',
            [
                'portable',
                'stationary'
            ]
        )->get(['id', 'slug']);

        $this->makeConsoles($sellers, $categories, $user->id);

        $this->makeDiscounts($user->id);

        $this->fillCart(
            $user,
            collect([
                Product::whereHas('category', fn($query) => $query->where('slug', 'portable'))->first(),
                Product::whereHas('category', fn($query) => $query->where('slug', 'stationary'))->first(),
            ])
        );
    }

    private function makeUser()
    {
        return User::factory()->create(
            [
                'name' => 'mihanya',
                'email' => 'mihanya@admin.com',
                'phone' => '123456789',
                'password' => Hash::make('password'),
                'permissions' => [
                    'platform.index' => true,
                    'platform.systems.index' => true,
                    'platform.systems.roles' => true,
                    'platform.systems.users' => true,
                    'platform.systems.attachment' => true,
                ]
            ]
        );
    }

    private function makeCategories()
    {
        $consoles = Category::create(
            [
                'slug' => 'console',
                'name' => '?????????????? ??????????????',
                'icon' => 'console'
            ]
        );

        $categories = [
            [
                'slug' => 'stationary',
                'name' => 'C??????????????????????',
                'icon' => 'stationary'
            ],
            [
                'slug' => 'portable',
                'name' => '??????????????????????',
                'icon' => 'portable'
            ],
        ];

        foreach ($categories as $category) {
            $consoles->children()->create($category);
        }
    }

    private function makeSellers()
    {
        $sellers = [
            [
                'title' => 'Game Console Store',
                'slug' => 'game-console-store',
                'phone' => '+79999999999',
                'email' => 'gcs@store.com',
                'description' => '?????????????? ?????????????? ???????????????? ???? ?????????? ???????? ?? ??????????????',
                'address' => '????????????',
            ],
            [
                'title' => 'Console Slave',
                'slug' => 'console-slave',
                'phone' => '+78888888888',
                'email' => 'slave@console.com',
                'description' => '??????????????????????????, ?????? ??????',
                'address' => '??????????-??????????????????',
            ],
            [
                'title' => 'Gamer Shop',
                'slug' => 'gamer-shop',
                'phone' => '+76666666666',
                'email' => 'shop@gamer.com',
                'description' => '?????????????? ?????? ????????????????',
                'address' => '????????????',
            ],
        ];

        foreach ($sellers as $seller) {
            Seller::factory()->create($seller);
        }
    }

    private function makeConsoles($sellers, $categories, $userId)
    {
        $this->checkDir();

        $imgDir = 'resources/mihanya/products/';

        $stationaryId = $categories->where('slug', 'stationary')->first()->id;
        $portableId = $categories->where('slug', 'portable')->first()->id;

        $products = [
            [
                'slug' => Str::slug('?????????????? ?????????????????? Sony PlayStation 5 825 ????'),
                'title' => '?????????????? ?????????????????? Sony PlayStation 5 825 ????',
                'description' => '???????????????????????? ???????????????? ???????????????? ?????????????????? ???????????????????????????????? ???????????????????? SSD, ?????????????????????? ???????????? ???????????????????? ?????????????????? ???????????????????? ????????????, ???????????????????? ?????????????????? ?????????????? ?? 3D-??????????, ?? ?????????? ?????????????????????? ???????? ???????????? ?????????????????? ?????? PlayStation.',
                'category_id' => $stationaryId,
                'vendor' => 'SONY',
                'props' => [
                    'main_image' => 'ps5_main.jpeg',
                    'images' => ['ps5_first.jpeg', 'ps5_second.jpeg'],
                    'price' => 49990,
                    'specifications' => [
                        'rom' => '825 ????',
                        'ram' => '16 384 ????',
                        'gpu' => 'AMD Custom RDNA2',
                        'cpu' => '8-?????????????? AMD',
                        'ssd' => true,
                        'source' => 'Blu-ray',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('?????????????? ?????????????????? Sony PlayStation 5 Digital Edition 825 ????'),
                'title' => '?????????????? ?????????????????? Sony PlayStation 5 Digital Edition 825 ????',
                'description' => 'PlayStation 5 - ???????????????????????? ?????????????? ?????????????? 9-???? ?????????????????? ???? Sony, ???????????????????????? ?? ???????? ?????????????????? ?????????????? ???????????????????? ?? ?????????????? ?????????????????????? ????????????????????. ?????????????????? ???????????????????????????? ???? ???????? AMD Radeon RDNA 2 (10,3 ??????????????????) ?? 8-???? ?????????????? ?????????????????? AMD Ryzen Zen 2 ?? ???????????????????? ?????????????? ???????????? ???? 120 fps ???????????????????????????????? ???????????????????????? ?????????????? ?? ???????????????????? ?? ?????????????????????? 4?? ?? 8?? ?????? ?????????????? ???????????????????????????????? ???????????????????? ?????? ????????????????, ?? ?????????? ?????????????????????? ???????????????? ???????????????????????? ?????????????????????????????? ???????????????????????? ?????? HD-??????????????????, ???????? ???????? ?? ?????? ?????? ?????????????????? 4??. ???????????????????????????????? ?????????????? ???????? SSD ?????????????????????? ?????????????????? ?? ?????????????????????????? ??????????????????????, ?????? ?? ?????????????????? ?? ???????????????? ?????????????????????? ?????????????? ???????????????? ?????????????????? ???????????????????? ???????????????? ???????????????? ??????, ?????????????? ?????? ????????????????????. ?????? ?????????????? ?????????????? ???????????????????????? ???????????????? ???????????????????? ??????????????????, ?? ???????????????????????????????????? ?????????????? DualSense ?????????????????? ???????????????? ?????? ???????????????? ???? ???????????????? ???????????????? ?????????? ?? ????????. ???????????????? ?????????????? PS5 ??? ?????? ???????????? ?????????????? PS5 ?????? ??????????????????. ?????????????? ?? ???????? ?????????????? ???????????? ?????? PlayStation Network ?? ?????????????????? ?? PlayStationStore, ?????????? ???????????????????? ?? ?????????????????? ????????.',
                'category_id' => $stationaryId,
                'vendor' => 'SONY',
                'props' => [
                    'main_image' => 'ps5_de_main.jpeg',
                    'images' => ['ps5_de_first.jpeg', 'ps5_de_second.png'],
                    'price' => 40990,
                    'specifications' => [
                        'rom' => '825 ????',
                        'ram' => '16 384 ????',
                        'gpu' => 'AMD Custom RDNA2',
                        'cpu' => '8-?????????????? AMD',
                        'ssd' => true,
                    ]
                ]
            ],
            [
                'slug' => Str::slug('?????????????? ?????????????????? Microsoft Xbox Series S 512 ????'),
                'title' => '?????????????? ?????????????????? Microsoft Xbox Series S 512 ????',
                'description' => '?????????????????? ?????????????????? ?????? ?????????? ?? ?????????? ???????? ?????????? ?????????????? ???????????????? ???????????????????? ?????? ?????????? ?????????? ?????????????????? Xbox. ?????????????????? ?????????? ???????????????????? ?????????????? ??????????, ???????????????????? ???????????????? ?? ???????????????????? Xbox Game Pass (?????????????????? ????????????????) ?????????????????? ???????????????? ?????????????? Xbox Series S ???????????????? ?????????? ???????????????? ???????????????????????? ?? ???????? ??????.',
                'category_id' => $stationaryId,
                'vendor' => 'Microsoft',
                'props' => [
                    'main_image' => 'xbox_ss_main.jpeg',
                    'images' => ['xbox_ss_first.png', 'xbox_ss_second.jpeg'],
                    'price' => 27990,
                    'specifications' => [
                        'rom' => '512 ????',
                        'ram' => '10 240 ????',
                        'gpu' => 'AMD Custom RDNA2',
                        'cpu' => '8-?????????????? AMD',
                        'ssd' => true,
                    ]
                ]
            ],
            [
                'slug' => Str::slug('?????????????? ?????????????????? Microsoft Xbox Series X 1 ????'),
                'title' => '?????????????? ?????????????????? Microsoft Xbox Series X 1 ????',
                'description' => 'Xbox Series X ??? ?????????????? ???????????? ??????????????????, ?????????????? ???????????????????????? ?????????????????????? ?????????????? ?????????????? ???? 120 ??/?? ?? ?????????? ?? ?????????????????????? HDR-????????????????. ?????????????????????? ?? ???????? ?? ??????????????, ?????????????????????? ?????????? ?????????????? ??????????????????????, ???????????? ???????????? ?? ???????????????????????? ???????????????? ?? ?????????????????????????????????? ???????????????? 4K. ?????????????????? ?????????? ?????????????? ???? ?????????????????? (SOC) ?? ?????????????????????? Xbox Velocity ???????????????????????? ???????????????????????? ????????????????, ?? ???? ?????????? ?????? ?????????????????? ?? ???????????????????????????????????? ?????????????????????????? ???????????????????? ?????????????? 1 ???? ???????????? ?????? ???????????? ???????????????? ?? ?????????????????? ?????????????????????? ?? 0-60 ???? 120 ??/??.',
                'category_id' => $stationaryId,
                'vendor' => 'Microsoft',
                'props' => [
                    'main_image' => 'xbox_sx_main.jpeg',
                    'images' => ['xbox_sx_first.jpeg', 'xbox_sx_second.png'],
                    'price' => 53150,
                    'specifications' => [
                        'rom' => '1 024 ????',
                        'ram' => '16 384 ????',
                        'gpu' => 'AMD Custom RDNA2',
                        'cpu' => '8-?????????????? AMD',
                        'ssd' => true,
                        'source' => 'Blu-ray',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('?????????????? ?????????????????? Sony PlayStation 4 Slim 500 ????'),
                'title' => '?????????????? ?????????????????? Sony PlayStation 4 Slim 500 ????',
                'description' => 'PlayStation 4 - ???????????? ???????????????????????? ?????????????? ?????????????? 8-???? ?????????????????? ???? Sony, ?????????????????????? ?? ???????? ?????????????? ?? ?????????????????????? ??????????????. ???????????????? ???????????????????? ?????????????????????????? ?? ???????????????????????? ??????, ???????????????????? ?????????????? ???????????? ????????, ?????????????????????? ?????????????? ?? ?????????????????? ???????????? ???????????????????????? ?????????? ???????????????????????????????????????? ?????????????????? ???????????????????????????????? ?????????????????? ???????????? ???????? ?????????? ???????????????? ?? ???????????????????? ?????? ?????????? ?? ??????????! PlayStation 4 Slim ???????????????? ?????????? ?????????? ?????? ???????????????????? ????????????, ?? ?????????? ???????????????????? ?????????? ?????????????????????? ?????????????????? ?? ?????????????????? ??????????, ?????????????? ???????????????? ???????????????????????? Slim. ?? ?????????????????? ?? ???????????? ?????????????? ???????????????????????? ?????????????????????? ???????????? ???????????????????? ???????????????? - DualShock 4 V2.',
                'category_id' => $stationaryId,
                'vendor' => 'SONY',
                'props' => [
                    'main_image' => 'ps4_slim_main.jpeg',
                    'images' => ['ps4_slim_first.jpeg', 'ps4_slim_second.jpeg'],
                    'price' => 29990,
                    'specifications' => [
                        'rom' => '500 ????',
                        'ram' => '8 192 ????',
                        'gpu' => '?????????????????????????????? AMD Radeon GPU',
                        'cpu' => '8-?????????????? AMD',
                        'ssd' => false,
                        'source' => 'Blu-ray',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('?????????????? ?????????????????? Sony PlayStation 4 Pro 1 ????'),
                'title' => '?????????????? ?????????????????? Sony PlayStation 4 Pro 1 ????',
                'description' => 'Sony PlayStation 4 Pro (1 TB) Black ?????????????????? ?????????????? ?????????? ???????? ???? ???????? ???????????????????? ???????????????????????? ?????????????????? ?????????????????????? ?? ?????????????????? ???????????????? ?? ???????????????? 4??. ?? ???????????????????? ???????????????????????????????????? ?? ???????????????????????? ??????????????, ?????????????? ?????????????????????? ?? ?????????????????????? ????????????????????, PS4 Pro ?????????????????? ???????????????? ?? ?????????? ?????????????? ???? ?????????????????????? ?????????????? ???????????? ?????????????? ?? ?????????????????????????????? ?????????????????? ??????????????????????. ???????????????????????? ?? 4?? ???????????????????????? ???????????? ?????????????????????? ?????????? ???????????? ???? PS4 ?? ???????????????????? ???????????????? ?? ?????????????????????? 4?? ?? ?????????? ?????????????? ?? ???????????????????? ???????????????? ????????????. ?????????? ????????, PS4 Pro ???????????????????????? ?????????????????????????????? 4??-??????????, ?????? ?????????????????? ???????????????????????? ?????????????????????????? ?????????????????? 4??, ?? ?????? ?????????? Netflix ?? YouTube. ?????????????? ?????????????????? ?????????????????? ?????? ???????? PS4 ?? ???????????????????? 1080 p, ?? ?????????? ???????????????? ?????????????? ???????????? ?? ???? ???????????????????????? ?????? ?????????????????? ???????????????????????????? ??????.',
                'category_id' => $stationaryId,
                'vendor' => 'SONY',
                'props' => [
                    'main_image' => 'ps4_pro_main.jpeg',
                    'images' => ['ps4_pro_first.jpeg', 'ps4_pro_second.jpeg'],
                    'price' => 47990,
                    'specifications' => [
                        'rom' => '1 000 ????',
                        'ram' => '8 192 ????',
                        'gpu' => '?????????????????????????????? AMD Radeon GPU',
                        'cpu' => '8-?????????????? AMD',
                        'ssd' => false,
                        'source' => 'Blu-ray',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('?????????????? ?????????????????? Nintendo Switch rev.2 32 ????'),
                'title' => '?????????????? ?????????????????? Nintendo Switch rev.2 32 ????',
                'description' => '???????????????????????? ???????????? ???????????????? ?????????????? Nintendo Switch ?? ???????????????????? ???????????????? ???????????????????? ????????????. ?????????? ???????????? ?????????????? ?????????????? ???? ??????, ?? ?????????????? ???? ??????????????. ????????????????, ???????????? ???????????? ?????????????? ???????????? ???????????????? ???? 5,5 ?????????? ???????? ?? The Legend of Zelda: Breath of the Wild.',
                'category_id' => $portableId,
                'vendor' => 'Nintendo',
                'props' => [
                    'main_image' => 'switch_main.png',
                    'images' => ['switch_first.jpeg', 'switch_second.jpeg'],
                    'price' => 22990,
                    'specifications' => [
                        'rom' => '32 ????',
                        'ram' => '4 096 ????',
                        'gpu' => 'Maxwell GPU',
                        'cpu' => '8-?????????????? NVIDIA Tegra',
                        'ssd' => false,
                        'source' => 'microSD, microSDHC, microSDXC',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('?????????????? ?????????????????? Nintendo Switch Lite 32 ????'),
                'title' => '?????????????? ?????????????????? Nintendo Switch Lite 32 ????',
                'description' => 'Nintendo Switch Lite ??? ?????????? ???????????????????? ?? ?????????????????? Nintendo Switch. ???????????????????? ?? ???????????? ?????????????? ???? ???????????????????? ??????????????????????. Nintendo Switch Lite ???????????????????????? ?????? ???????? Nintendo Switch, ?? ?????????????? ?????????? ???????????? ?? ?????????????????????? ????????????. ?????????????? ?????????????? ???????????????? ?????? ??????, ?????? ?????????? ???????????? ?????? ????????, ?? ?????? ??????, ?????? ?????????? ???????????? ?? ?????????????? ?????? ?????????????????? ???????????????????????? ?? ???????????????? ?? ??????????????, ?? ?????????????? ?????? ???????? ?????????????????????? ???????????? Nintendo Switch.',
                'category_id' => $portableId,
                'vendor' => 'Nintendo',
                'props' => [
                    'main_image' => 'switch_lite_main.jpeg',
                    'images' => ['switch_lite_first.jpeg', 'switch_lite_second.png'],
                    'price' => 13190,
                    'specifications' => [
                        'rom' => '32 ????',
                        'ram' => '4 096 ????',
                        'gpu' => 'Maxwell GPU',
                        'cpu' => '8-?????????????? NVIDIA Tegra',
                        'ssd' => false,
                        'source' => 'microSD, microSDHC, microSDXC',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('?????????????? ?????????????????? Nintendo 3DS 1 ????'),
                'title' => '?????????????? ?????????????????? Nintendo 3DS 1 ????',
                'description' => '?????????????????????? ?????????????? ?????????????? ???????????????????????? Nintendo, ?????????????????? ?????????????????? ???????????????????? ???????????? ?????????????????????? ???? ???????? ????????????????????????????????, ???? ???????? ?????? ?????????????????????????? ?????????????????????? ??????????.',
                'category_id' => $portableId,
                'vendor' => 'Nintendo',
                'props' => [
                    'main_image' => '3ds_main.jpeg',
                    'images' => ['3ds_first.jpeg', '3ds_second.jpeg'],
                    'price' => 1590,
                    'specifications' => [
                        'rom' => '2 ???? SDHC',
                        'ram' => '1 ???? flash',
                        'gpu' => 'DMP PICA200',
                        'cpu' => 'ARM11',
                        'ssd' => false,
                        'source' => 'SD, SDHC',
                    ]
                ]
            ],
        ];

        foreach ($products as $product) {
            $shuffledSellers = $sellers->shuffle();
            $props = array_pop($product);
            $mainImage = $props['main_image'];
            $mainImage = $this->makeImage($mainImage, $imgDir, $userId);

            $images = $props['images'] ?? [];
            $images = $this->makeImages($images, $imgDir, $userId);

            $product['main_image_id'] = $mainImage->id;
            $product = Product::factory()->create($product);

            for ($i = 0; $i < 2; $i++) {
                $product->sellers()->attach(
                    $shuffledSellers->get($i)->id,
                    ['price' => $props['price'] + rand(-(int) $props['price'] / 2, (int) $props['price'] / 2)]
                );
            }

            $product->images()->saveMany($images);

            foreach ($props['specifications'] as $spec => $val) {
                $specId = Specification::where('slug', $spec)->first()->id;
                $product->specifications()
                    ->attach($specId, ['value' => $val]);
            }
        }
    }

    private function makeImage($mainImage, $imgDir, $userId)
    {
        File::copy($imgDir . $mainImage, $this->fullPath . $mainImage);

        $img = [
            'name' => pathinfo($this->fullPath . $mainImage)['filename'],
            'original_name' => 'blob',
            'mime' => mime_content_type($this->fullPath . $mainImage),
            'extension' => pathinfo($this->fullPath . $mainImage)['extension'],
            'path' => $this->path,
            'user_id' => $userId,
            'size' => filesize($this->fullPath . $mainImage),
            'hash' => sha1_file($this->fullPath . $mainImage),
        ];

        return Attachment::create($img);
    }

    private function makeImages($images, $imgDir, $userId)
    {
        $attachments = [];
        foreach ($images as $image) {
            $attachments[] = $this->makeImage($image, $imgDir, $userId);
        }

        return $attachments;
    }

    private function checkDir()
    {
        if (!is_dir($this->fullPath)) {
            mkdir($this->fullPath, recursive: true);
        }
    }

    private function makeSpecifications()
    {
        $specifications = [
            [
                'title' => '?????????? ????????????',
                'slug' => 'rom',
                'type' => Specification::SELECT,
            ],
            [
                'title' => '?????????????????????? ????????????',
                'slug' => 'ram',
                'type' => Specification::SELECT,
            ],
            [
                'title' => '?????????????????????? ??????????????????',
                'slug' => 'gpu',
                'type' => Specification::SELECT,
            ],
            [
                'title' => '?????? ????????????????????',
                'slug' => 'cpu',
                'type' => Specification::SELECT,
            ],
            [
                'title' => '?????? ???????????????? ?????? ??????',
                'slug' => 'source',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'SSD',
                'slug' => 'ssd',
                'type' => Specification::CHECKBOX,
            ],
        ];

        foreach ($specifications as $specification) {
            Specification::create($specification);
        }
    }

    private function makeDiscounts($userId)
    {
        $this->PortableAndStationaryDiscount($userId);
        $this->SonyDiscount($userId);
    }

    private function PortableAndStationaryDiscount($userId)
    {
        $image = $this->makeImage('p_and_s.jpeg', 'resources/mihanya/discounts/', $userId);

        $discount = Discount::create(
            [
                'slug' => Str::slug('portable and stationary discount'),
                'title' => '???????? ?????????????????????? ?? ???????????????????????? ?????????????? ?????????????? - ???????????? ???????????? 20%',
                'value' => '20',
                'begin_at' => now()->addDays(-20),
                'end_at' => now()->addDays(+150),
                'unit_type' => Discount::UNIT_PERCENT,
                'priority' => 1500,
                'type' => Discount::GROUP,
                'image_id' => $image->id
            ],
        );

        $unit = DiscountUnit::create(['discount_id' => $discount->id]);

        $categories = Category::where('slug', 'portable')
            ->orWhere('slug', 'stationary')
            ->get();

        $unit->categories()->saveMany($categories);
    }

    private function SonyDiscount($userId)
    {
        $sony = Product::where('vendor', 'SONY')->get();

        $image = $this->makeImage('sony.jpeg', 'resources/mihanya/discounts/', $userId);

        $discount['image_id'] = $image->id;

        $discount = Discount::create(
            [
                'slug' => 'sony-discount',
                'title' => '???????????? ???? ?????????????? ?????????????? SONY - 9%',
                'value' => '9',
                'begin_at' => now()->addDays(-30),
                'end_at' => now()->addDays(120),
                'unit_type' => Discount::UNIT_PERCENT,
                'priority' => 1100,
                'type' => Discount::PRODUCT,
                'image_id' => $image->id
            ]
        );

        $unit = DiscountUnit::create(['discount_id' => $discount->id]);

        $unit->products()->saveMany($sony);
    }

    private function fillCart(User $user, Collection $products): void
    {
        Cart::factory([
            'visitor_id' => Visitor::factory([
                'user_id' => $user->id,
            ])
        ])
            ->create()
            ->products()->attach(
                $products
                    ->mapWithKeys(fn($item) => [
                        $item->id => [
                            'seller_id' => $item->sellers->random()->id,
                            'amount' => 1,
                        ]
                    ])
            )
        ;

    }
}
