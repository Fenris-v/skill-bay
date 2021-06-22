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
                'name' => 'Игровые консоли',
                'icon' => 'console'
            ]
        );

        $categories = [
            [
                'slug' => 'stationary',
                'name' => 'Cтационарные',
                'icon' => 'stationary'
            ],
            [
                'slug' => 'portable',
                'name' => 'Портативные',
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
                'description' => 'Магазин игровых консолей на любой вкус и кошелек',
                'address' => 'Москва',
            ],
            [
                'title' => 'Console Slave',
                'slug' => 'console-slave',
                'phone' => '+78888888888',
                'email' => 'slave@console.com',
                'description' => 'Консолехолопы, для вас',
                'address' => 'Санкт-Петербург',
            ],
            [
                'title' => 'Gamer Shop',
                'slug' => 'gamer-shop',
                'phone' => '+76666666666',
                'email' => 'shop@gamer.com',
                'description' => 'Магазин для геймеров',
                'address' => 'Москва',
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
                'slug' => Str::slug('Игровая приставка Sony PlayStation 5 825 Гб'),
                'title' => 'Игровая приставка Sony PlayStation 5 825 Гб',
                'description' => 'Молниеносная скорость загрузки благодаря сверхскоростному накопителю SSD, невероятный эффект погружения благодаря тактильной отдаче, адаптивным спусковым кнопкам и 3D-звуку, а также потрясающие игры нового поколения для PlayStation.',
                'category_id' => $stationaryId,
                'vendor' => 'SONY',
                'props' => [
                    'main_image' => 'ps5_main.jpeg',
                    'images' => ['ps5_first.jpeg', 'ps5_second.jpeg'],
                    'price' => 49990,
                    'specifications' => [
                        'rom' => '825 ГБ',
                        'ram' => '16 384 Мб',
                        'gpu' => 'AMD Custom RDNA2',
                        'cpu' => '8-ядерный AMD',
                        'ssd' => true,
                        'source' => 'Blu-ray',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Игровая приставка Sony PlayStation 5 Digital Edition 825 ГБ'),
                'title' => 'Игровая приставка Sony PlayStation 5 Digital Edition 825 ГБ',
                'description' => 'PlayStation 5 - стационарная игровая консоль 9-го поколения от Sony, совместившая в себе передовые игровые технологии и богатый мультимедиа функционал. Мощнейший видеопроцессор на базе AMD Radeon RDNA 2 (10,3 терафлопс) и 8-ми ядерный процессор AMD Ryzen Zen 2 с поддержкой частоты кадров до 120 fps продемонстрируют великолепную графику в видеоиграх в разрешениях 4К и 8К при наличии соответствующего телевизора или монитора, а также максимально наполнят качественным кристаллическим изображением ваш HD-телевизор, даже если в нем нет поддержки 4К. Высокоскоростной жесткий диск SSD молниеносно загружает и воспроизводит медиаданные, что в сравнении с прошлыми поколениями игровых консолей исключает длительное ожидание загрузки игр, локаций или сохранений. Ваш игровой процесс сопроводится объёмным трехмерным звучанием, а сверхтехнологичный геймпад DualSense тактильно передаст все ощущения от игрового процесса прямо в руки. Цифровое издание PS5 — это версия консоли PS5 без дисковода. Войдите в свою учетную запись для PlayStation Network и перейдите в PlayStationStore, чтобы приобрести и загрузить игры.',
                'category_id' => $stationaryId,
                'vendor' => 'SONY',
                'props' => [
                    'main_image' => 'ps5_de_main.jpeg',
                    'images' => ['ps5_de_first.jpeg', 'ps5_de_second.png'],
                    'price' => 40990,
                    'specifications' => [
                        'rom' => '825 ГБ',
                        'ram' => '16 384 Мб',
                        'gpu' => 'AMD Custom RDNA2',
                        'cpu' => '8-ядерный AMD',
                        'ssd' => true,
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Игровая приставка Microsoft Xbox Series S 512 ГБ'),
                'title' => 'Игровая приставка Microsoft Xbox Series S 512 ГБ',
                'description' => 'Следующее поколение игр несёт с собой нашу самую большую цифровую библиотеку для нашей самой маленькой Xbox. Благодаря более динамичным игровым мирам, ускоренной загрузке и добавлению Xbox Game Pass (продаётся отдельно) полностью цифровая консоль Xbox Series S является самым выгодным предложением в мире игр.',
                'category_id' => $stationaryId,
                'vendor' => 'Microsoft',
                'props' => [
                    'main_image' => 'xbox_ss_main.jpeg',
                    'images' => ['xbox_ss_first.png', 'xbox_ss_second.jpeg'],
                    'price' => 27990,
                    'specifications' => [
                        'rom' => '512 Гб',
                        'ram' => '10 240 Мб',
                        'gpu' => 'AMD Custom RDNA2',
                        'cpu' => '8-ядерный AMD',
                        'ssd' => true,
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Игровая приставка Microsoft Xbox Series X 1 ТБ'),
                'title' => 'Игровая приставка Microsoft Xbox Series X 1 ТБ',
                'description' => 'Xbox Series X — консоль нового поколения, которая обеспечивает сенсационно плавную частоту до 120 к/с и яркую и контрастную HDR-картинку. Погрузитесь в игру с головой, наслаждаясь более чёткими персонажами, яркими мирами и невероятными деталями в сверхреалистичном качестве 4K. Сочетание новой системы на кристалле (SOC) и архитектуры Xbox Velocity обеспечивает максимальную скорость, в то время как процессор и специализированный твердотельный накопитель объёмом 1 ТБ отдают вам полный контроль и позволяют разгоняться с 0-60 до 120 к/с.',
                'category_id' => $stationaryId,
                'vendor' => 'Microsoft',
                'props' => [
                    'main_image' => 'xbox_sx_main.jpeg',
                    'images' => ['xbox_sx_first.jpeg', 'xbox_sx_second.png'],
                    'price' => 53150,
                    'specifications' => [
                        'rom' => '1 024 Гб',
                        'ram' => '16 384 Мб',
                        'gpu' => 'AMD Custom RDNA2',
                        'cpu' => '8-ядерный AMD',
                        'ssd' => true,
                        'source' => 'Blu-ray',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Игровая приставка Sony PlayStation 4 Slim 500 ГБ'),
                'title' => 'Игровая приставка Sony PlayStation 4 Slim 500 ГБ',
                'description' => 'PlayStation 4 - мощная стационарная игровая консоль 8-го поколения от Sony, совмещающая в себе игровые и мультимедиа функции. Огромное количество платформенных и эксклюзивных игр, уникальные сетевые режимы игры, бесподобная графика и множество других особенностей этого многофункционального домашнего развлекательного комплекса долгие годы будут радовать и впечатлять Вас снова и снова! PlayStation 4 Slim работает менее шумно чем предыдущая модель, а также отличается более компактными размерами и сниженным весом, поэтому получила аббревиатуру Slim. В комплекте с данной моделью поставляется обновленная версия фирменного геймпада - DualShock 4 V2.',
                'category_id' => $stationaryId,
                'vendor' => 'SONY',
                'props' => [
                    'main_image' => 'ps4_slim_main.jpeg',
                    'images' => ['ps4_slim_first.jpeg', 'ps4_slim_second.jpeg'],
                    'price' => 29990,
                    'specifications' => [
                        'rom' => '500 Гб',
                        'ram' => '8 192 Мб',
                        'gpu' => 'Интегрированный AMD Radeon GPU',
                        'cpu' => '8-ядерный AMD',
                        'ssd' => false,
                        'source' => 'Blu-ray',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Игровая приставка Sony PlayStation 4 Pro 1 ТБ'),
                'title' => 'Игровая приставка Sony PlayStation 4 Pro 1 ТБ',
                'description' => 'Sony PlayStation 4 Pro (1 TB) Black обеспечит игрокам новый опыт за счёт улучшенных возможностей обработки изображения и поддержки картинки в качестве 4К. С повышением производительности и возможностей системы, включая центральный и графический процессоры, PS4 Pro позволяет добиться в играх графики со значительно большим числом деталей и беспрецедентной чёткостью изображения. Пользователи с 4К телевизорами смогут насладиться всеми играми на PS4 в улучшенном качестве с разрешением 4К и более высокой и стабильной частотой кадров. Кроме того, PS4 Pro поддерживает воспроизведение 4К-видео, что позволяет пользоваться стриминговыми сервисами 4К, в том числе Netflix и YouTube. Система позволяет запускать все игры PS4 в разрешении 1080 p, а также повысить частоту кадров и её стабильность для некоторых поддерживаемых игр.',
                'category_id' => $stationaryId,
                'vendor' => 'SONY',
                'props' => [
                    'main_image' => 'ps4_pro_main.jpeg',
                    'images' => ['ps4_pro_first.jpeg', 'ps4_pro_second.jpeg'],
                    'price' => 47990,
                    'specifications' => [
                        'rom' => '1 000 Гб',
                        'ram' => '8 192 Мб',
                        'gpu' => 'Интегрированный AMD Radeon GPU',
                        'cpu' => '8-ядерный AMD',
                        'ssd' => false,
                        'source' => 'Blu-ray',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Игровая приставка Nintendo Switch rev.2 32 ГБ'),
                'title' => 'Игровая приставка Nintendo Switch rev.2 32 ГБ',
                'description' => 'Представляем вашему вниманию консоль Nintendo Switch с улучшенным временем автономной работы. Время работы батареи зависит от игр, в которые вы играете. Например, одного заряда батареи хватит примерно на 5,5 часов игры в The Legend of Zelda: Breath of the Wild.',
                'category_id' => $portableId,
                'vendor' => 'Nintendo',
                'props' => [
                    'main_image' => 'switch_main.png',
                    'images' => ['switch_first.jpeg', 'switch_second.jpeg'],
                    'price' => 22990,
                    'specifications' => [
                        'rom' => '32 ГБ',
                        'ram' => '4 096 Мб',
                        'gpu' => 'Maxwell GPU',
                        'cpu' => '8-ядерный NVIDIA Tegra',
                        'ssd' => false,
                        'source' => 'microSD, microSDHC, microSDXC',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Игровая приставка Nintendo Switch Lite 32 ГБ'),
                'title' => 'Игровая приставка Nintendo Switch Lite 32 ГБ',
                'description' => 'Nintendo Switch Lite — новое пополнение в семействе Nintendo Switch. Компактная и лёгкая консоль со встроенным управлением. Nintendo Switch Lite поддерживает все игры Nintendo Switch, в которые можно играть в портативном режиме. Консоль отлично подойдёт для тех, кто много играет вне дома, и для тех, кто хочет играть в сетевом или локальном мультиплеере с друзьями и родными, у которых уже есть флагманская модель Nintendo Switch.',
                'category_id' => $portableId,
                'vendor' => 'Nintendo',
                'props' => [
                    'main_image' => 'switch_lite_main.jpeg',
                    'images' => ['switch_lite_first.jpeg', 'switch_lite_second.png'],
                    'price' => 13190,
                    'specifications' => [
                        'rom' => '32 ГБ',
                        'ram' => '4 096 Мб',
                        'gpu' => 'Maxwell GPU',
                        'cpu' => '8-ядерный NVIDIA Tegra',
                        'ssd' => false,
                        'source' => 'microSD, microSDHC, microSDXC',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Игровая приставка Nintendo 3DS 1 ГБ'),
                'title' => 'Игровая приставка Nintendo 3DS 1 ГБ',
                'description' => 'Портативная игровая система производства Nintendo, способная создавать трёхмерный эффект изображения за счёт автостереоскопии, то есть без использования специальных очков.',
                'category_id' => $portableId,
                'vendor' => 'Nintendo',
                'props' => [
                    'main_image' => '3ds_main.jpeg',
                    'images' => ['3ds_first.jpeg', '3ds_second.jpeg'],
                    'price' => 1590,
                    'specifications' => [
                        'rom' => '2 Гб SDHC',
                        'ram' => '1 Гб flash',
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
                'title' => 'Объем памяти',
                'slug' => 'rom',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'Оперативная память',
                'slug' => 'ram',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'Графический процессор',
                'slug' => 'gpu',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'Тип процессора',
                'slug' => 'cpu',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'Тип носителя для игр',
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
                'title' => 'Купи портативную и стационарную игровую консоль - получи скидку 20%',
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
                'title' => 'Скидка на игровые консоли SONY - 9%',
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
