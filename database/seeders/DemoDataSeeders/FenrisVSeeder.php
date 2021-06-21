<?php

namespace Database\Seeders\DemoDataSeeders;

use App\Models\Attachment;
use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountUnit;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Specification;
use App\Models\User;
use File;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

// art db:seed --class=Database\\Seeders\\DemoDataSeeders\\FenrisVSeeder
class FenrisVSeeder extends Seeder
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

        $this->makeSellers();

        $this->makeCategories();

        $this->makeSpecifications();

        $sellers = Seller::whereIn(
            'slug',
            [
                'drive-store',
                'super-bike',
                'bike-store'
            ]
        )->get();

        $categories = Category::whereIn(
            'slug',
            [
                'niner',
                'fatbike',
                'bike'
            ]
        )->get(['id', 'slug']);

        $this->makeBikes($sellers, $categories, $userId);

        $this->makeAccessories($sellers, $userId);

        $this->makeDiscounts($userId);
    }

    private function makeUser()
    {
        $user = User::factory()->create(
            [
                'name' => 'fenris',
                'email' => 'fenris@admin.com',
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

    private function makeAccessories($sellers, $userId)
    {
        $imgDir = 'resources/fenris/accessories/';

        $this->checkDir();

        $categoryId = Category::where('slug', 'accessories')->first()->id;

        $products = [
            [
                'slug' => Str::slug('Корзина детская 20х14х13см пласт. универс. крепл. на руль/багаж. (48) розовая'),
                'title' => 'Корзина детская 20х14х13см пласт. универс. крепл. на руль/багаж. (48) розовая',
                'description' => 'Корзина детская, универсальное крепление на руль или багажник, логотип лошадка',
                'category_id' => $categoryId,
                'vendor' => 'none',
                'props' => [
                    'price' => 390,
                    'main_image' => '5_431556.jpg',
                ]
            ],
            [
                'slug' => Str::slug('Корзинка детская на руль Vinca sport P 04 Princess Kate'),
                'title' => 'Корзинка детская на руль Vinca sport P 04 Princess Kate',
                'description' => 'Детская корзинка на руль диаметров 20-24 мм.',
                'category_id' => $categoryId,
                'vendor' => 'none',
                'props' => [
                    'price' => 490,
                    'main_image' => '477_p04_princess_kate_1_.jpg',
                ]
            ],
            [
                'slug' => Str::slug(
                    'Корзина детская 25х15х14,5см сталь универс. крепл. на руль/багаж. розовая с лого лошадка'
                ),
                'title' => 'Корзина детская 25х15х14,5см сталь универс. крепл. на руль/багаж. розовая с лого лошадка',
                'description' => 'Корзина детская, универсальное крепление на руль/багажник',
                'category_id' => $categoryId,
                'vendor' => 'none',
                'props' => [
                    'price' => 590,
                    'main_image' => '5_431428.jpg',
                ]
            ],
            [
                'slug' => Str::slug('Корзинка детская на руль Vinca sport Р 06 Fairy Camilla'),
                'title' => 'Корзинка детская на руль Vinca sport Р 06 Fairy Camilla',
                'description' => 'Детская корзинка на руль диаметров 12-14 мм.',
                'category_id' => $categoryId,
                'vendor' => 'none',
                'props' => [
                    'price' => 700,
                    'main_image' => '887_r_06_fairy_camilla_1_.jpg',
                ]
            ],
        ];

        foreach ($products as $product) {
            $shuffledSellers = $sellers->shuffle();
            $props = array_pop($product);
            $mainImage = $props['main_image'];
            $mainImage = $this->makeImage($mainImage, $imgDir, $userId);

            $product['main_image_id'] = $mainImage->id;
            $product = Product::create($product);

            for ($i = 0; $i < 2; $i++) {
                $product->sellers()->attach(
                    $shuffledSellers->get($i)->id,
                    ['price' => $props['price'] + rand(-50, 50)]
                );
            }
        }
    }

    private function makeSpecifications()
    {
        $specifications = [
            [
                'title' => 'Задний переключатель',
                'slug' => 'rear-derailleur',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'Передний переключатель',
                'slug' => 'front-derailleur',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'Диаметр колеса',
                'slug' => 'diameter',
                'type' => Specification::MULTIPLE,
            ],
            [
                'title' => 'Гидравлический тормоз',
                'slug' => 'hydraulic',
                'type' => Specification::CHECKBOX,
            ],
            [
                'title' => 'Материал рамы',
                'slug' => 'frame-material',
                'type' => Specification::SELECT,
            ],
            [
                'title' => 'Обвес',
                'slug' => 'body-kit',
                'type' => Specification::SELECT,
            ],
        ];

        foreach ($specifications as $specification) {
            Specification::create($specification);
        }
    }

    private function makeSellers()
    {
        $sellers = [
            [
                'title' => 'Drive Store',
                'slug' => 'drive-store',
                'phone' => '+79999999999',
                'email' => 'drive@store.com',
                'description' => 'Лучший магазин велосипедов',
                'address' => 'Москва',
            ],
            [
                'title' => 'Super bike',
                'slug' => 'super-bike',
                'phone' => '+79999999999',
                'email' => 'super@store.com',
                'description' => 'Лучший магазин велосипедов',
                'address' => 'Санкт-Петербург',
            ],
            [
                'title' => 'Bike store',
                'slug' => 'bike-store',
                'phone' => '+79999999999',
                'email' => 'bike@store.com',
                'description' => 'Лучший магазин велосипедов',
                'address' => 'Москва',
            ],
        ];

        foreach ($sellers as $seller) {
            Seller::factory()->create($seller);
        }
    }

    private function makeCategories()
    {
        $bikes = Category::create(
            [
                'slug' => 'bike',
                'name' => 'Велосипеды',
                'icon' => 'bike'
            ]
        );

        $categories = [
            [
                'slug' => 'niner',
                'name' => 'Найнеры',
                'icon' => 'bike'
            ],
            [
                'slug' => 'fatbike',
                'name' => 'Фэтбайки',
                'icon' => 'bike'
            ],
            [
                'slug' => 'accessories',
                'name' => 'Аксессуары',
                'icon' => 'bike'
            ]
        ];

        foreach ($categories as $category) {
            $bikes->children()->create($category);
        }
    }

    private function makeBikes($sellers, $categories, $userId)
    {
        $this->checkDir();

        $imgDir = 'resources/fenris/bikes/';

        $fatbikeId = $categories->where('slug', 'fatbike')->first()->id;
        $ninerId = $categories->where('slug', 'niner')->first()->id;

        $products = [
            [
                'slug' => Str::slug('Велосипед GIANT Yukon 2 2021'),
                'title' => 'Велосипед GIANT Yukon 2 2021',
                'description' => 'Фэтбайк Yukon 2 2021 от Giant – настоящий внедорожник, на котором можно ездить по бездорожью, песку, снегу. Низкий центр тяжести алюминиевой рамы придает велосипеду отличную устойчивость. Ригидная вилка с широким зазором обеспечивает четкость управления. Широкие бескамерные покрышки позволяют хардтейлу проезжать по самым труднопроходимым местам. Втулки на промподшипниках гарантируют плавное вращение колес. Интегрированная каретка Prowheel придает прочности узлу. Трансмиссия Shimano помогает преодолевать подъемы, взбираться на холмы, экономить усилия при движении по сыпучим, рыхлым поверхностям. Дисковые гидравлические тормоза Sram мгновенно останавливают байк вне зависимости от погодных условий.',
                'category_id' => $fatbikeId,
                'vendor' => 'GIANT',
                'props' => [
                    'main_image' => 'MY21_Yukon_2_Color_A.jpg',
                    'price' => 144000,
                    'specifications' => [
                        'rear-derailleur' => 'Shimano Deore',
                        'diameter' => '27,5"',
                        'hydraulic' => true,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед STELS Aggressor HD 24 2021'),
                'title' => 'Велосипед STELS Aggressor HD 24 2021',
                'description' => 'Подростковый фэтбайк STELS Aggressor с алюминиевой рамой и широкими колесами 24 дюймовыми колесами. Основные преимущества велосипеда – дисковые гидравлические тормоза, жесткая стальная вилка и 8-скоростная трансмиссия.',
                'category_id' => $fatbikeId,
                'vendor' => 'STELS',
                'props' => [
                    'price' => 37200,
                    'main_image' => '89bd12840bc760abe320abb1c79769b5.jpeg',
                    'images' => [
                        '485f719471f1bb7b47076f979c4f4ada.jpeg',
                    ],
                    'specifications' => [
                        'rear-derailleur' => 'Shimano Acera',
                        'diameter' => '24"',
                        'hydraulic' => true,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед TECH TEAM Garet 26 2021'),
                'title' => 'Велосипед TECH TEAM Garet 26 2021',
                'description' => 'Вы не желаете останавливаться ни перед чем и хотите ездить на своем байке в любую погоду, по снегу, песку или грязи? Фэтбайк Garet 26 2021 Tech Team станет вашим надежным спутником в поездках по бездорожью, лесным тропам, по набережным. С ним можно не ограничиваться велопрогулками летом в парке. Покрышки CST толщиной 4 дюйма обеспечат надежное сцепление с любой поверхностью. Дисковые механические тормоза остановят фэт на мокрой дороге или при минусовой температуре. Трансмиссия на 7 скоростей позволит меньше уставать, преодолевая большие дистанции, получая массу впечатлений.',
                'category_id' => $fatbikeId,
                'vendor' => 'TECH TEAM',
                'props' => [
                    'price' => 33540,
                    'main_image' => 'garet_26.png',
                    'specifications' => [
                        'rear-derailleur' => 'Shimano TZ-500',
                        'diameter' => '26"',
                        'hydraulic' => false,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед BLACK ONE Monster 24 D 2021'),
                'title' => 'Велосипед BLACK ONE Monster 24 D 2021',
                'description' => 'Monster 24 D 2021 от Black One – подростковый велосипед, который проедет по любой дороге или самому сложному бездорожью. Этому фэтбайку нипочем снег, песок, мокрые и скользкие тропинки – он устойчив и хорошо управляем. Собран на базе прочной стальной рамы, оборудован картриджной кареткой для плавного вращения шатунов. Жесткая вилка и безрезьбовая рулевая гарантируют четкость управления. Широкие покрышки плавно амортизируют кочки и неровности рельефа. Преодолевать подъемы помогает трансмиссия на 7 скоростей с задним переключателем Shimano Tourney. Контролировать байк позволяют дисковые тормоза механического типа.',
                'category_id' => $fatbikeId,
                'vendor' => 'Black One',
                'props' => [
                    'price' => 29820,
                    'main_image' => 'cc30de4958893506d00f12b9bdc6d33e.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'Shimano Tourney',
                        'diameter' => '24"',
                        'hydraulic' => false,
                        'frame-material' => 'Сталь',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед STELS Aggressor MD 20 2021'),
                'title' => 'Велосипед STELS Aggressor MD 20 2021',
                'description' => 'Велосипед для подростков Aggressor MD 20 2021 от Stels – фэтбайк, на котором юный райдер может кататься по любой поверхности: асфальт, грунт, гравий, песок и даже снег. Ключевые характеристики Стелс Агрессор MD 20 – устойчивость и проходимость. Легкая, прочная алюминиевая рама хорошо выдерживает нагрузки. Жесткая вилка улучшает управляемость. Трансмиссия Shimano на 7 скоростей позволяет экономить силы на подъемах. Дисковая механическая тормозная система быстро останавливает байк в любых условиях.',
                'category_id' => $fatbikeId,
                'vendor' => 'STELS',
                'props' => [
                    'price' => 29500,
                    'main_image' => 'ba6477c7a2d3c867432c86f59803db1d.jpeg',
                    'images' => [
                        '22261183db4ddbcb8fe89c9a1bbcda7c.jpeg'
                    ],
                    'specifications' => [
                        'rear-derailleur' => 'Shimano Tourney',
                        'diameter' => '20"',
                        'hydraulic' => false,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед STELS Aggressor MD 26 2021'),
                'title' => 'Велосипед STELS Aggressor MD 26 2021',
                'description' => 'Фэт-байк с колёсами 26" и механическими дисковыми тормозами от популярного российского бренда Stels. Лёгкая и прочная алюминиевая рама технологически позволила достичь минимального веса. Спортивная посадка и очень широкая резина превратят в удовольствие поездку по неровной поверхности и преодоление препятствий в виде песка или снега. Трансмиссия любительского уровня с 8 скоростями позволит выбрать комфортный темп передвижения.',
                'category_id' => $fatbikeId,
                'vendor' => 'STELS',
                'props' => [
                    'price' => 39410,
                    'main_image' => '821b7d0e466aea5aeba3500dab3921f3.jpeg',
                    'specifications' => [
                        'rear-derailleur' => 'Shimano Acera',
                        'diameter' => '26"',
                        'hydraulic' => false,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед STARK Rocket Fat 24.2 D 2020'),
                'title' => 'Велосипед STARK Rocket Fat 24.2 D 2020',
                'description' => 'Подростковый фэтбайк для тех, кто хочет кататься по песку, снегу, бездорожью любой сложности, а также не отказывать себе в удовольствии отправиться на велопрогулку в городской парк. Широкие колеса обеспечивают отличную амортизацию и проходимость. Жесткая вилка простая в обслуживании и выносливая. Rocket Fat 24.2 D 2020 оснащен дисковыми тормозами механического типа, надежными и эффективными. На модели 2020 трансмиссия имеет одну звезду спереди и кассету с увеличенным диапазоном, что делает переключение передач интуитивно понятным.',
                'category_id' => $fatbikeId,
                'vendor' => 'STARK',
                'props' => [
                    'price' => 33030,
                    'main_image' => '60b61a1741cd4dfd510b584a9a63a3d1.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'Shimano FD',
                        'diameter' => '24"',
                        'hydraulic' => false,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед BLACK ONE Monster 26 D 2021'),
                'title' => 'Велосипед BLACK ONE Monster 26 D 2021',
                'description' => 'Спешите купить Велосипед BLACK ONE Monster 26 D 2021 по цене 31 990 руб. в Санкт-Петербурге и других городах России.',
                'category_id' => $fatbikeId,
                'vendor' => 'Black One',
                'props' => [
                    'price' => 31990,
                    'main_image' => '22009.jpg',
                    'specifications' => [
                        'diameter' => '26"',
                        'hydraulic' => false,
                        'frame-material' => 'Сталь',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед FORWARD BIZON MINI 24" 2020'),
                'title' => 'Велосипед FORWARD BIZON MINI 24" 2020',
                'description' => 'Подростковый велосипед для мальчиков и девочек, возраст: 9-12 лет. Фатбайк FORWARD BIZON MINI 24" из модельного ряда 2020 года позволит кататься как в городе, так и по любым типам загородных дорог и трасс. Модель оборудована удобной низкой рамой, механикой таких брендов как Shimano, Sun Race и FWD, семискоростной трансмиссией, надежными дисковыми тормозами Power BX-351 и вилкой FWD 286 с ходом 50 миллиметров. Байк имеет колеса диаметром 24 дюйма с широкими универсальними покрышками Wanda P1272 24x3.0", имеющими отличное сцепление со всеми типами покрытия.',
                'category_id' => $fatbikeId,
                'vendor' => 'FORWARD',
                'props' => [
                    'price' => 27490,
                    'main_image' => 'forward_24_bizon_mini_blue.jpg',
                    'images' => [
                        'forward_24_bizon_mini_yellow.jpg'
                    ],
                    'specifications' => [
                        'rear-derailleur' => 'Shimano Tourney',
                        'diameter' => '24"',
                        'hydraulic' => false,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед SILVERBACK SCOOP HALF 24 2019'),
                'title' => 'Велосипед SILVERBACK SCOOP HALF 24 2019',
                'description' => 'Спешите купить Велосипед SILVERBACK SCOOP HALF 24 2019 по цене 59 700 руб. в Санкт-Петербурге и других городах России.',
                'category_id' => $fatbikeId,
                'vendor' => 'SILVERBACK',
                'props' => [
                    'price' => 59700,
                    'main_image' => '0058786.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'Shimano Altus',
                        'diameter' => '24"',
                        'hydraulic' => false,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед SILVERBACK Superspeed 1.0 29 2019'),
                'title' => 'Велосипед SILVERBACK Superspeed 1.0 29 2019',
                'description' => 'Спешите купить Велосипед SILVERBACK Superspeed 1.0 29 2019 по цене 275 780 руб. в Санкт-Петербурге и других городах России.',
                'category_id' => $ninerId,
                'vendor' => 'SILVERBACK',
                'props' => [
                    'price' => 275780,
                    'main_image' => '40fd21bace41009894be20ae40cbed09.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'Shimano XT',
                        'diameter' => '29"',
                        'hydraulic' => true,
                        'frame-material' => 'Карбон',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед GIANT XTC Advanced 29 2 2021'),
                'title' => 'Велосипед GIANT XTC Advanced 29 2 2021',
                'description' => 'Горный велосипед XTC Advanced 29 2 2021 от Giant – найнер в топовой комплектации с огромным спортивным потенциалом для кросс-кантрийных гонок, соревнований на бездорожье. Байк собран на базе карбоновой бесшовной рамы с внутренней проводкой тросов. Конусный рулевой стакан обеспечивает жесткость рулевого узла и высокую управляемость велосипеда. Каретка на увеличенных промподшипниках интегрирована в раму, она выдерживает большие ударные нагрузки и не нуждается в обслуживании. Профессиональная трансмиссия Shimano SLX на 12 скоростей позволяет быстро и четко менять передачи при самом агрессивном катании. Задний переключатель сделан по Shadow технологии, не позволяющей ему выступать за пределы кассеты, что обеспечивает высокую прочность и ударостойкость. Безопасность райдера гарантируется дисковыми гидравлическими тормозами Shimano MT500.',
                'category_id' => $ninerId,
                'vendor' => 'GIANT',
                'props' => [
                    'price' => 235000,
                    'main_image' => 'MY21-XTC_ADV_29_2_Color-A-Teal_Carbon.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'Shimano SLX',
                        'diameter' => '29"',
                        'hydraulic' => true,
                        'frame-material' => 'Карбон',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед SCOTT Scale 960 2021'),
                'title' => 'Велосипед SCOTT Scale 960 2021',
                'description' => 'Горный велосипед Scale 960 2021 от компании Scott подойдет как для гонок кросс-кантри, так и в качестве первого маунтинбайка. Геометрия алюминиевой рамы Скотт Скейл 960 обеспечивает удобную посадку. Воздушная вилка RockShox Judy со 100-миллиметровым ходом имеет функцию удаленной блокировки, что обеспечивает универсальность этого хардтейла - на нем можно уверенно мчать по сложному бездорожью или ездить по ровному асфальту в городе. Кевларовые покрышки Maxxis Rekon Race за счет жесткой центральной части способствуют отличному накату, а мягкие боковины увеличивают контроль. 12-скоростная трансмиссия с одной звездой спереди не утяжеляет байк, предоставляя в распоряжение райдера достойный арсенал режимов педалирования для успешного преодоления разного рельефа.',
                'category_id' => $ninerId,
                'vendor' => 'Scott',
                'props' => [
                    'price' => 127980,
                    'main_image' => '15210.970.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'SRAM NX',
                        'diameter' => '29"',
                        'hydraulic' => true,
                        'frame-material' => 'Карбон',
                        'body-kit' => 'SRAM',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед GIANT Fathom 29 1 2020'),
                'title' => 'Велосипед GIANT Fathom 29 1 2020',
                'description' => 'Ощутите удовольствие от уверенной езды по легкому бездорожью и сложным трассам кросс-кантри с хардтейлом Fathom 29 1 2020! Вы будете полностью контролировать свой байк на спуске и эффективно взбираться на подъем благодаря обновленной геометрии рамы и системе Giant WheelSystem с уже установленными бескамерными шинами. Оптимальную четткость рулевого управления обеспечивает вилка, сделанная по технологии Giant OverDrive. Алюминиевая рама из сплава 6061 имеет отличное соотношение прочности и веса.',
                'category_id' => $ninerId,
                'vendor' => 'GIANT',
                'props' => [
                    'price' => 124900,
                    'main_image' => 'MY20Fathom291_ColorA.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'SRAM NX',
                        'diameter' => '29"',
                        'hydraulic' => true,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'SRAM',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед AUTHOR Instinct 29 ASL 2021'),
                'title' => 'Велосипед AUTHOR Instinct 29 ASL 2021',
                'description' => 'Женский горный велосипед Instinct 29 ASL 2021 - надежный найнер от AUTHOR. Алюминиевая рама, изготовленная по технологии двойного баттинга, имеет большой ресурс прочности. Втулки на промподшипниках не нужно регулярно обслуживать, они медленно изнашиваются, обеспечивают хороший накат в течение всего срока пользования. На велосипед можно устанавливать полноразмерные крылья. С женской моделью Инстинкт 29 можно тренироваться, исследовать лесные или горные тропы, участвовать в соревнованиях.',
                'category_id' => $ninerId,
                'vendor' => 'AUTHOR',
                'props' => [
                    'price' => 103560,
                    'main_image' => 'instinct_29_asl.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'Shimano Deore',
                        'diameter' => '29"',
                        'hydraulic' => true,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед FORMAT 1212 29 2020'),
                'title' => 'Велосипед FORMAT 1212 29 2020',
                'description' => 'FORMAT 1212 29 - мужской велосипед горного типа (MTB) среднего уровня из модельного ряда 2020 года, оснащенный всем необходимым для серьезных занятий маунтин-байком. Рама из легкого и прочного алюминиевого сплава, качественная трансмиссия с комплектом механики Shimano Deore и поддержкой 20 скоростей, надежные тормоза Shimano M201 дискового типа, вилка амортизационного типа Rock Shox Recon RL с ходом 100 миллиметров и колеса диаметром 29 дюймов с универсальными, прочными шинами для любых дорожных покрытий Mitas Scylla TEXTRA.',
                'category_id' => $ninerId,
                'vendor' => 'FORMAT',
                'props' => [
                    'price' => 91000,
                    'main_image' => 'f0a0069e6d04622e83cbe19d1aae4a77.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'Shimano Deore',
                        'front-derailleur' => 'Shimano Deore',
                        'diameter' => '29"',
                        'hydraulic' => true,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед STINGER Zeta Evo 29 2021'),
                'title' => 'Велосипед STINGER Zeta Evo 29 2021',
                'description' => 'Горный велосипед Zeta Evo 29 2021 от Stinger – универсальный найнер с трейловой геометрией, подходящий для тренировок или катания по тропам разной сложности на пересеченной местности, в байк парках. Рама сделана из алюминия по технологии двойного баттинга и гидроформинга, что повышает прочность и торсионную жесткость и при этом снижает вес. Тросы коммуникаций защищены от повреждения, загрязнения внутренней проводкой. Эффективная амортизация достигается благодаря воздушно-масляной вилке с возможностью блокировки. Трансмиссия Sram на 12 скоростей позволяет легко преодолевать любые подъемы, быстро разгоняться на спусках и ровных участках пути. Дисковая гидравлическая тормозная система от Sram страхует райдера, делает езду на Стингер Зета Эво 29 по бездорожью безопасной.',
                'category_id' => $ninerId,
                'vendor' => 'STINGER',
                'props' => [
                    'price' => 80900,
                    'main_image' => '147052_99.jpg.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'SRAM SX',
                        'front-derailleur' => 'SRAM SX',
                        'diameter' => '29"',
                        'hydraulic' => true,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'SRAM',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед Format 1213 29 2019'),
                'title' => 'Велосипед Format 1213 29 2019',
                'description' => 'Прочно занявший позицию универсального велосипед. В этой модели собраны достоинства разного рода направлений, за счет этого можно смело чередовать рельеф, не бояться плохой погоды и проезжать большие расстояния за короткий промежуток времени. Количество скоростей 27, что дает возможность подобрать необходимую частоту вращения. Навесное оборудование любительского уровня и высокого качества, рама спроектирована с помощью новых технологий для хорошей прочности без увеличения веса.',
                'category_id' => $ninerId,
                'vendor' => 'FORMAT',
                'props' => [
                    'price' => 79900,
                    'main_image' => 'c34a1dc9596f638710445b5b7d5c2753_1_1_.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'Shimano Alivio',
                        'front-derailleur' => 'Shimano Alivio',
                        'diameter' => '29"',
                        'hydraulic' => true,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед MARIN Bobcat Trail 5 29 2020'),
                'title' => 'Велосипед MARIN Bobcat Trail 5 29 2020',
                'description' => 'MARIN Bobcat Trail - это горный велосипед с современной трейловой геометрией, созданный для исследования трейловых трасс и синглтреков. Лучшая в своем классе прочная рама, плюс востребованные спецификации делают Bobcat Trail надежным выбором для райдера, который хочет погрузиться в мир современного горного велосипеда, а также для опытных гонщиков в поисках самосовершенствования, мечтающих взять от жизни всё.',
                'category_id' => $ninerId,
                'vendor' => 'MARIN',
                'props' => [
                    'price' => 79710,
                    'main_image' => '20_BTT_5_gallery.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'Shimano Deore',
                        'diameter' => '29"',
                        'hydraulic' => true,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
                    ]
                ]
            ],
            [
                'slug' => Str::slug('Велосипед AUTHOR Spirit 29 2021'),
                'title' => 'Велосипед AUTHOR Spirit 29 2021',
                'description' => 'Горный велосипед Spirit 29 2021 от Author создан для райдеров, не пасующих перед трудностями бездорожья или малопроходимых троп. Байк собран на базе облегченной алюминиевой гидроформированной рамы. Трансмиссия Shimano Alivio на 18 скоростей обеспечивает беспроблемное преодоление подъемов, отличается быстрой и четкой сменой режимов на любом рельефе. Картриджная каретка того же производителя не нуждается в регулярном обслуживании, гарантирует плавную работу шатунов весь период эксплуатации Автор Спирит 29. Страхуют велосипедиста семироторные дисковые гидравлические тормоза.',
                'category_id' => $ninerId,
                'vendor' => 'AUTHOR',
                'props' => [
                    'price' => 74340,
                    'main_image' => 'spirit_29.jpg',
                    'specifications' => [
                        'rear-derailleur' => 'Shimano Alivio',
                        'front-derailleur' => 'Shimano Alivio',
                        'diameter' => '29"',
                        'hydraulic' => true,
                        'frame-material' => 'Алюминий',
                        'body-kit' => 'Shimano',
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
        File::move($imgDir . $mainImage, $this->fullPath . $mainImage);

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

    private function makeDiscounts($userId)
    {
        $this->stelsDiscount($userId);
        $this->fatbikeDiscount($userId);
    }

    private function fatbikeDiscount($userId)
    {
        $image = $this->makeImage('sale.png', 'resources/fenris/', $userId);

        $discount = Discount::create(
            [
                'slug' => 'fatbike-accessories',
                'title' => 'Купи корзинку и фэтбайк - получи скидку 250руб.',
                'value' => '250',
                'begin_at' => now()->addDays(-20),
                'end_at' => now()->addDays(+150),
                'unit_type' => Discount::UNIT_CURRENCY,
                'priority' => 1200,
                'type' => Discount::GROUP,
                'image_id' => $image->id
            ],
        );

        $unit = DiscountUnit::create(['discount_id' => $discount->id]);

        $categories = Category::where('slug', 'fatbike')
            ->orWhere('slug', 'accessories')
            ->get();

        $unit->categories()->saveMany($categories);
    }

    private function stelsDiscount($userId)
    {
        $stels = Product::where('slug', 'like', '%stels%')->get();

        $image = $this->makeImage('15.png', 'resources/fenris/', $userId);

        $discount['image_id'] = $image->id;

        $discount = Discount::create(
            [
                'slug' => 'stels-discount',
                'title' => 'Скидка на велосипеды STELS',
                'value' => '15',
                'begin_at' => now()->addDays(-30),
                'end_at' => now()->addDays(120),
                'unit_type' => Discount::UNIT_PERCENT,
                'priority' => 1100,
                'type' => Discount::PRODUCT,
                'image_id' => $image->id
            ]
        );

        $unit = DiscountUnit::create(['discount_id' => $discount->id]);

        $unit->products()->saveMany($stels);
    }
}
