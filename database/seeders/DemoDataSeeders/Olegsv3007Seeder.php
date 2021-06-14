<?php

namespace Database\Seeders\DemoDataSeeders;

use App\Models\Attachment;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Specification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use File;

// art db:seed --class=Database\\Seeders\\DemoDataSeeders\\Olegsv3007Seeder
class Olegsv3007Seeder extends Seeder
{
    const STORAGE = 'storage/app/public/';

    public string $path;
    public string $fullPath;

    public function __construct()
    {
        $year = (string)now()->year;

        $month = (string)now()->month;
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
        $userId = $this->makeUser();
        $this->makeCategories();
        $this->makeSellers();
        $this->makeSpecifications();

        $categories = Category::all();
        $sellers = Seller::all();


        $this->makeSmartphones($sellers, $categories, $userId);
        $this->makeSmartWatches($sellers, $categories, $userId);


    }

    private function makeUser()
    {
        $user = User::factory()->create(
            [
                'name' => 'oleg',
                'email' => 'oleg@admin.com',
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

        return $user->id;
    }

    private function makeCategories()
    {
        $categories = [
            [
                'slug' => 'gadgets',
                'name' => 'Гаджеты',
                'icon' => 'teapot',
                'children' => [
                    [
                        'slug' => 'smartphones',
                        'name' => 'Смартфоны',
                        'icon' => 'smartphone',
                    ],[
                        'slug' => 'smartwatches',
                        'name' => 'Умные часы',
                        'icon' => 'tv',
                    ],[
                        'slug' => 'portable_audio',
                        'name' => 'Портативная акустика',
                        'icon' => 'soundbar',
                    ],
                ],
            ],
            [
                'slug' => 'appliances',
                'name' => 'Бытовая техника',
                'icon' => 'stove',
                'children' => [
                    [
                        'slug' => 'fridge',
                        'name' => 'Холодильники',
                        'icon' => 'stove',
                    ],[
                        'slug' => 'microwaves',
                        'name' => 'Микроволновые печи',
                        'icon' => 'microwave',
                    ],[
                        'slug' => 'multicooker',
                        'name' => 'Мультиварки',
                        'icon' => 'blender',
                    ],[
                        'slug' => 'dishwashers',
                        'name' => 'Посудомоечные машины',
                        'icon' => 'washing_machine',
                    ],
                ],
            ],
            [
                'slug' => 'tv_and_video',
                'name' => 'Телевизоры и видео',
                'icon' => 'tv',
                'children' => [
                    [
                        'slug' => 'tv',
                        'name' => 'Телевизоры и видео',
                        'icon' => 'tv',
                    ],
                    [
                        'slug' => 'tv_bracing',
                        'name' => 'Крепления для телевизоров',
                        'icon' => 'lamp',
                    ],
                    [
                        'slug' => 'tv_box',
                        'name' => 'ТВ приставки',
                        'icon' => 'microwave',
                    ],
                    [
                        'slug' => 'antennas',
                        'name' => 'Антенны',
                        'icon' => 'camera',
                    ],
                ],
            ],
            [
                'slug' => 'laptops_and_tablets',
                'name' => 'Ноутбуки и планшеты',
                'icon' => 'discount',
                'children' => [
                    [
                        'slug' => 'laptops',
                        'name' => 'Ноутбуки',
                        'icon' => 'headphones',
                    ],
                    [
                        'slug' => 'tablets',
                        'name' => 'Планшеты',
                        'icon' => 'tv',
                    ],
                    [
                        'slug' => 'ebooks',
                        'name' => 'Электронные книги',
                        'icon' => 'tv',
                    ],
                ],
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }

    private function makeSellers()
    {
        $sellers = [
            [
                'title' => 'EComp',
                'slug' => 'e_comp',
                'phone' => '+79999999999',
                'email' => 'ecomp@store.com',
                'description' => 'Лучший магазин техники',
                'address' => 'Москва',
            ],
            [
                'title' => 'Super comp',
                'slug' => 'super_comp',
                'phone' => '+79999999999',
                'email' => 'super@store.com',
                'description' => 'Лучший магазин техники',
                'address' => 'Санкт-Петербург',
            ],
            [
                'title' => 'Comp store',
                'slug' => 'comp_store',
                'phone' => '+79999999999',
                'email' => 'comp@store.com',
                'description' => 'Лучший магазин техники',
                'address' => 'Москва',
            ],
        ];

        foreach ($sellers as $seller) {
            Seller::factory()->create($seller);
        }
    }

    private function makeSpecifications()
    {
        $specifications = [
            [
                'title' => 'Версия ОС на начало продаж',
                'slug' => 'os',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'Материал корпуса',
                'slug' => 'material',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'Количество SIM-карт',
                'slug' => 'sim_amount',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'Бесконтактная оплата',
                'slug' => 'nfc',
                'type' => Specification::CHECKBOX,
            ],
            [
                'title' => 'Тип экрана',
                'slug' => 'screen_type',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'Размер изображения',
                'slug' => 'screen_resolution',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'Объем оперативной памяти',
                'slug' => 'ram',
                'type' => Specification::SELECT,
            ],
        ];

        foreach ($specifications as $specification) {
            Specification::create($specification);
        }
    }


    private function makeSmartphones($sellers, $categories, $userId)
    {
        $this->checkDir();

        $imgDir = 'resources/olegsv/smartphones/';

        $smartphonesId = $categories->where('slug', 'smartphones')->first()->id;

        $products = [
            [
                'slug' => Str::slug('Смартфон Apple iPhone SE 2020 128Gb'),
                'title' => 'Смартфон Apple iPhone SE 2020 128Gb',
                'description' => 'iPhone SE — это самый мощный компактный iPhone с множеством передовых технологий. A13 Bionic — самый быстрый процессор для iPhone, обеспечивающий максимальную производительность для приложений, игр и фотосъёмки. Портретный режим и шесть эффектов освещения для фотографий студийного качества. Технология Smart HDR нового поколения для невероятной детализации даже в светлых и тёмных областях кадра. Видео 4K кинематографического качества. И самые продвинутые функции iOS. Долгое время работы без подзарядки и защита от воды — всё, за что вы любите iPhone, в удивительно компактном корпусе.',
                'category_id' => $smartphonesId,
                'vendor' => 'Apple',
                'props' => [
                    'main_image' => 'SE_2020_main.jpg',
                    'price' => 39990,
                    'specifications' => [
                        'os' => 'IOS 13',
                        'material' => 'Алюминий',
                        'sim_amount' => 2,
                        'nfc' => true,
                        'screen_type' => 'IPS',
                        'screen_resolution' => '1334 x 750',
                        'ram' => '3Гб',
                    ],
                    'images' => [
                        'SE_2020_1.jpg',
                        'SE_2020_2.jpg',
                        'SE_2020_3.jpg',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Смартфон Apple iPhone Xr 128GB'),
                'title' => 'Смартфон Apple iPhone Xr 128GB',
                'description' => 'iPhone XR получил 6,1-дюймовый жидкокристаллический дисплей Liquid Retina в стиле iPhone X, систему на флагманском процессоре A12, поддержку революционной функции распознавания Face ID, одинарную, но улучшенную камеру, 3 ГБ оперативной памяти, поддержку беспроводной зарядки и много других примечательных особенностей.',
                'category_id' => $smartphonesId,
                'vendor' => 'Apple',
                'props' => [
                    'main_image' => 'XR_main.jpg',
                    'price' => 52970,
                    'specifications' => [
                        'os' => 'IOS 12',
                        'material' => 'Алюминий и стекло',
                        'sim_amount' => 2,
                        'nfc' => true,
                        'screen_type' => 'IPS',
                        'screen_resolution' => '1792 x 828',
                        'ram' => '3Гб',
                    ],
                    'images' => [
                        'XR_1.jpg',
                        'XR_2.jpg',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Смартфон Apple iPhone 11 64GB'),
                'title' => 'Смартфон Apple iPhone 11 64GB',
                'description' => 'Функциональный и стильный смартфон Apple iPhone 11 в металлическом корпусе способен обеспечить не только повседневное общение и развлечения, но и продуктивную работу. Для этого он оснащен мощным процессором Apple A13 Bionic из 6 ядер, поддерживающим слаженную работу всех комплектующих, а также модулем ОЗУ объемом в 4 ГБ, что предусматривает быстрое переключение между открытыми приложениями и возможность играть в игры. Основная (12;12 Мп) и фронтальная (12 Мп) камеры позволят создавать фотошедевры. Изображение на экране смартфона Apple iPhone 11 диагональю 6.1 дюйма обладает поразительной детализацией и цветопередачей. Олеофобное покрытие исключает сильное загрязнение экрана. Корпус смартфона имеет высокую степень пылевлагозащиты (IP68), благодаря чему обеспечивается эффективная и длительная работа устройства. Несъемный аккумулятор емкостью 3110 мА·ч поддерживает беспроводную зарядку, что сделает данный процесс более легким и быстрым.',
                'category_id' => $smartphonesId,
                'vendor' => 'Apple',
                'props' => [
                    'main_image' => '11_main.jpg',
                    'price' => 54990,
                    'specifications' => [
                        'os' => 'IOS 13',
                        'material' => 'Металл и стекло',
                        'sim_amount' => 2,
                        'nfc' => true,
                        'screen_type' => 'IPS',
                        'screen_resolution' => '1792 x 828',
                        'ram' => '4Гб',
                    ],
                    'images' => [
                        '11_1.jpg',
                        '11_2.jpg',
                        '11_3.jpg',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Смартфон Apple iPhone 12 128GB'),
                'title' => 'Смартфон Apple iPhone 12 128GB',
                'description' => 'Apple iPhone 12 — ультрамощный смартфон от престижного бренда. Девайс получил молниеносный процессор A14 Bionic и впечатляющий дисплей Super Retina XDR от края до края. Набор продвинутых камер эффективно работает даже в условиях слабого освещения. Видеоролики Dolby Vision завораживают реалистичностью. Фотовозможности гаджета колоссальны. Широкоугольный датчик теперь улавливает значительно больше света. Проработка нюансов очень точная днем и ночью. Портретный режим обеспечивает художественное размытие фона, выделяя самое главное. Смартфон объединяет прорывные возможности с легендарным дизайном. Apple iPhone 12 это выбор активного пользователя.',
                'category_id' => $smartphonesId,
                'vendor' => 'Apple',
                'props' => [
                    'main_image' => '12_main.jpg',
                    'price' => 72490,
                    'specifications' => [
                        'os' => 'IOS 14',
                        'material' => 'Алюминий и стекло',
                        'sim_amount' => 2,
                        'nfc' => true,
                        'screen_type' => 'OLED',
                        'screen_resolution' => '2532 x 1170',
                        'ram' => '4Гб',
                    ],
                    'images' => [
                        '12_1.png',
                        '12_2.jpg',
                        '12_3.jpg',
                        '12_4.jpg',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Смартфон Xiaomi Redmi 9 4/64GB'),
                'title' => 'Смартфон Xiaomi Redmi 9 4/64GB ',
                'description' => 'Современный смартфон со свежим и интересным дизайном и достаточной для любых задач мощностью. Элегантность во всем Xiaomi Redmi 9 — аккуратная и сбалансированная модель, она производит впечатление с первого взгляда. Градиентные цвета задней поверхности выглядят свежо. Отличающаяся по текстуре круглая площадка, на которой расположена система камер, подчеркивает индивидуальность гаджета. Дизайнерские решения еще и практичны: мелкая текстура задней поверхности защищает яркий корпус от отпечатков пальцев, пыли и грязи. Экран Full HD с разрешением 2340x1080 пикселей позволит наслаждаться любым контентом: от фильмов и фотографий до игр. При этом глаза не устанут благодаря новым технологиям защиты от синего излучения. А высокая производительность, которую обеспечивают 8-ядерный процессор, мощный графический чип и 4 ГБ оперативной памяти, позволит полностью погрузиться в новые впечатления.',
                'category_id' => $smartphonesId,
                'vendor' => 'Xiaomi',
                'props' => [
                    'main_image' => 'redmi9_main.jpg',
                    'price' => 10990,
                    'specifications' => [
                        'os' => 'Android 10',
                        'material' => 'Стекло и пластик',
                        'sim_amount' => 2,
                        'nfc' => true,
                        'screen_type' => 'IPS',
                        'screen_resolution' => '2340 x 1080',
                        'ram' => '4Гб',
                    ],
                    'images' => [
                        'redmi9_1.jpg',
                        'redmi9_2.jpg',
                        'redmi9_3.jpg',

                    ]
                ]
            ],
            [
                'slug' => Str::slug('Смартфон Xiaomi Redmi Note 10 Pro 8/128GB'),
                'title' => 'Смартфон Xiaomi Redmi Note 10 Pro 8/128GB ',
                'description' => 'Современный смартфон со свежим и интересным дизайном и достаточной для любых задач мощностью. Элегантность во всем Xiaomi Redmi 9 — аккуратная и сбалансированная модель, она производит впечатление с первого взгляда. Градиентные цвета задней поверхности выглядят свежо. Отличающаяся по текстуре круглая площадка, на которой расположена система камер, подчеркивает индивидуальность гаджета. Дизайнерские решения еще и практичны: мелкая текстура задней поверхности защищает яркий корпус от отпечатков пальцев, пыли и грязи. Экран Full HD с разрешением 2340x1080 пикселей позволит наслаждаться любым контентом: от фильмов и фотографий до игр. При этом глаза не устанут благодаря новым технологиям защиты от синего излучения. А высокая производительность, которую обеспечивают 8-ядерный процессор, мощный графический чип и 4 ГБ оперативной памяти, позволит полностью погрузиться в новые впечатления.',
                'category_id' => $smartphonesId,
                'vendor' => 'Xiaomi',
                'props' => [
                    'main_image' => 'redmi_note_10_main.jpg',
                    'price' => 28990,
                    'specifications' => [
                        'os' => 'Android 11',
                        'material' => 'Стекло и пластик',
                        'sim_amount' => 2,
                        'nfc' => true,
                        'screen_type' => 'AMOLED',
                        'screen_resolution' => '2400 x 1080',
                        'ram' => '8Гб',
                    ],
                    'images' => [
                        'redmi_note_10_1.jpg',
                        'redmi_note_10_2.jpg',
                        'redmi_note_10_3.jpg',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Смартфон Xiaomi Poco M3'),
                'title' => 'Смартфон Xiaomi Poco M3 ',
                'description' => 'Смартфон POCO M3 оснащен широким FHD+ дисплеем с диагональю 6.53", который позволит Вам ещё глубже погрузиться в происходящее на экране. Большая диагональ и соотношение сторон 19.5:9 покажут Вам больше, чем обычные смартфоны. Емкий аккумулятор на 6000 мАч в сочетании с низким энергопотреблением процессора Snapdragon 662 обеспечивают POCO M3 поразительно длительным временем работы. Прослушивание музыки, просмотр видео или долгие звонки - не важно, заряда хватит действительно надолго. POCO M3 оснащается мощным 11-нм восьмиядерным процессором Snapdragon 662, работающим с графическим чипом Adreno 610 GPU. Память LPDDR4X поддерживает одновременную работу нескольких приложений и игра, в то время как хранилище UFS 2.2 обеспечивает более высокую скорость чтения и превосходную производительность, сокращая время на запуск и открытие приложений.',
                'category_id' => $smartphonesId,
                'vendor' => 'Xiaomi',
                'props' => [
                    'main_image' => 'Xiaomin_poco_m3_main.png',
                    'price' => 28990,
                    'specifications' => [
                        'os' => 'Android 10',
                        'material' => 'Пластик',
                        'sim_amount' => 2,
                        'nfc' => true,
                        'screen_type' => 'IPS',
                        'screen_resolution' => '2340 x 1080',
                        'ram' => '4Гб',
                    ],
                    'images' => [
                        'Xiaomi_poco_m3_1.jpg',
                        'Xiaomi_poco_m3_2.jpg',
                        'Xiaomi_poco_m3_3.jpg',
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
                    ['price' => $props['price'] + rand(-3500, 3500)]
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

    private function makeSmartWatches($sellers, $categories, $userId)
    {
        $this->checkDir();

        $imgDir = 'resources/olegsv/smartwatches/';

        $smartwatchesId = $categories->where('slug', 'smartwatches')->first()->id;

        $products = [
            [
                'slug' => Str::slug('Умные часы Apple Watch SE GPS 40мм'),
                'title' => 'Умные часы Apple Watch SE GPS 40мм',
                'description' => 'Большой дисплей Retina, на котором поместится всё, что нужно. Продвинутые датчики для отслеживания любой физической активности. Полезные функции, которые помогают следить за показателями здоровья и заботятся о вашей безопасности. Apple Watch SE — часы, которые помогут вам ценить каждую секунду.',
                'category_id' => $smartwatchesId,
                'vendor' => 'Apple',
                'props' => [
                    'main_image' => 'SE_main.jpg',
                    'price' => 24990,
                    'specifications' => [
                        'os' => 'Watch OS',
                        'material' => 'Алюминий',
                        'nfc' => true,
                        'screen_type' => 'OLED',
                        'screen_resolution' => '324 x 394',
                    ],
                    'images' => [
                        'SE_1.jpg',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Умные часы Apple Watch Series 6 GPS 40мм'),
                'title' => 'Умные часы Apple Watch Series 6 GPS 40мм',
                'description' => 'Apple Watch Series 6 позволяют вам измерять уровень кислорода в крови с помощью потрясающего нового датчика и специального приложения. Просматривайте показатели физической активности на улучшенном, всегда включённом дисплее Retina, который теперь светится в 2,5 раза ярче на улице, в неактивном режиме, когда рука с часами внизу. Настройте набор действий, необходимых вам перед сном, и отслеживайте свой режим сна. Отвечайте на звонки и сообщения прямо с запястья. Это мощное устройство, с которым гораздо проще вести более здоровый образ жизни, быть активнее и оставаться на связи.',
                'category_id' => $smartwatchesId,
                'vendor' => 'Apple',
                'props' => [
                    'main_image' => 'S6_main.jpg',
                    'price' => 36900,
                    'specifications' => [
                        'os' => 'Watch OS',
                        'material' => 'Алюминий',
                        'nfc' => true,
                        'screen_type' => 'OLED',
                        'screen_resolution' => '324 x 394',
                    ],
                    'images' => [
                        'S6_1.jpg',
                        'S6_2.jpg',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Умные часы Apple Watch Series 5 GPS 44мм'),
                'title' => 'Умные часы Apple Watch Series 5 GPS 44мм',
                'description' => 'Эти часы не спускают глаз с вашего сердца. Они умеют быстро измерять сердечный ритм. А ещё вы можете настроить уведомления о слишком низком и высоком пульсе.
Их стиль можно менять на свой вкус — просто установите на часы другой ремешок, и они мгновенно преобразятся. Продвинутые фитнес-показатели, GPS-модуль, водонепроницаемость на глубине до 50 метров — у них есть всё, чтобы отслеживать самые разные тренировки. Кольца активности показывают ваш прогресс и вдохновляют больше двигаться, меньше сидеть и быть энергичнее. Вы даже можете соревноваться с друзьями и сравнивать свои достижения.',
                'category_id' => $smartwatchesId,
                'vendor' => 'Apple',
                'props' => [
                    'main_image' => 'S5_main.jpg',
                    'price' => 36900,
                    'specifications' => [
                        'os' => 'Watch OS',
                        'material' => 'Алюминий',
                        'nfc' => true,
                        'screen_type' => 'OLED',
                        'screen_resolution' => '368 x 448',
                    ],
                    'images' => [
                        'S5_1.jpg',
                        'S5_2.jpg',
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
                    ['price' => $props['price'] + rand(-3500, 3500)]
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
}
