<?php

namespace Database\Seeders\DemoDataSeeders;

use App\Models\Attachment;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Specification;
use App\Models\User;
use File;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

// sail artisan db:seed --class=Database\\Seeders\\DemoDataSeeders\\RSarvarovSeeder
class RSarvarovSeeder extends Seeder
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

    /**
     * Запуск сидера.
     *
     * @return void
     */
    public function run()
    {
        $userId = $this->createUser();
        $sellers = $this->createSellers($userId);
        $categories = $this->createCategories($userId);
        $this->createBanners($userId);

        $this->createProducts($userId, $sellers, $categories);
    }

    private function createUser()
    {
        $user = User::factory()->create(
            [
                'name' => 'rsarvarov',
                'email' => 'rsarvarov@admin.com',
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

    private function createBanners(int $userId)
    {
        $this->checkDir();

        $imgDir = 'resources/rsarvarov/banners/';

        $bannersArray = [
            [
                'title' => 'Новый iMac',
                'description' => 'Уже в продаже. Успей приобрести, пока не раскупили!',
                'url' => '/products/imac',
                'is_active' => 1,
                'props' => [
                    'image' => 'imac.png',
                ],
            ],
            [
                'title' => 'Ты меломан?',
                'description' => 'В нашем магазине есть много крутых наушников специально для тебя!',
                'url' => '/catalog/headphones',
                'is_active' => 1,
                'props' => [
                    'image' => 'headphonesbanners.png',
                ],
            ],
        ];

        foreach ($bannersArray as $banner) {
            $props = array_pop($banner);
            $image = $props['image'];
            $image = $this->makeImage($image, $imgDir, $userId);

            $banner['image_id'] = $image->id;

            Banner::factory()->create($banner);
        }

        return $this;
    }

    private function createSellers(int $userId)
    {
        $this->checkDir();

        $sellersArray = [
            [
                'title' => 'reStore',
                'slug' => 're-store',
                'phone' => '+79991234567',
                'email' => 'help@re-store.ru',
                'description' => 'Сеть фирменных магазинов техники Apple и аксессуаров в крупнейших городах России.',
                'address' => 'Москва',
                'props' => [
                    'image' => 'restore.jpg'
                ],
            ],
            [
                'title' => 'М.Видео',
                'slug' => 'mvideo',
                'phone' => '+79997654321',
                'email' => 'contact@mvideo.ru',
                'description' => 'российская торговая сеть по продаже бытовой техники и электроники.',
                'address' => 'Москва',
                'props' => [
                    'image' => 'mvideo.png'
                ],
            ],
            [
                'title' => 'DNS',
                'slug' => 'dns',
                'phone' => '+79991112233',
                'email' => 'info@dns.ru',
                'description' => 'интернет магазин цифровой и бытовой техники.',
                'address' => 'Москва',
                'props' => [
                    'image' => 'dns.jpg'
                ],
            ],
        ];

        $sellers = collect();

        $imgDir = 'resources/rsarvarov/sellers/';

        foreach ($sellersArray as $seller) {
            $props = array_pop($seller);
            $mainImage = $props['image'];
            $mainImage = $this->makeImage($mainImage, $imgDir, $userId);

            $seller['image_id'] = $mainImage->id;

            $sellers[] = Seller::factory()->create($seller);
        }

        return $sellers;
    }

    private function createCategories(int $userId)
    {
        $this->checkDir();

        $imgDir = 'resources/rsarvarov/categories/';

        $categoriesArray = [
            [
                'slug' => 'smartphone',
                'name' => 'Смартфоны',
                'icon' => 'smartphone',
                'is_hot' => 1,
                'props' => [
                    'image' => 'smartphones.png',
                ],
            ],
            [
                'slug' => 'pc',
                'name' => 'Компьютеры',
                'icon' => 'tv',
                'is_hot' => 1,
                'props' => [
                    'image' => 'pc.png',
                ],
            ],
            [
                'slug' => 'headphones',
                'name' => 'Наушники',
                'icon' => 'headphones',
                'is_hot' => 1,
                'props' => [
                    'image' => 'headphones.png',
                ],
            ]
        ];

        $categories = collect();

        $i = 0;
        foreach ($categoriesArray as $category) {
            $props = array_pop($category);
            $image = $props['image'];
            $image = $this->makeImage($image, $imgDir, $userId);

            $category['image_id'] = $image->id;
            $category['hot_order'] = $i++;

            $categories[] = Category::create($category);
        }

        return $categories;
    }

    private function createProducts(int $userId, Collection $sellers, Collection $categories)
    {
        $this->checkDir();

        $imgDir = 'resources/rsarvarov/products/';

        $smartPhoneCategoryId = $categories->firstWhere('slug', 'smartphone')->id;
        $pcCategoryId = $categories->firstWhere('slug', 'pc')->id;
        $headphonesCategoryId = $categories->firstWhere('slug', 'headphones')->id;

        $products = [
            [
                'title' => 'iPhone X',
                'slug' => Str::slug('iPhone X'),
                'description' => 'Новый смартфон от Apple c 5,8-дюймовым экраном, без кнопки Home, но с системой распознавания лиц.',
                'category_id' => $smartPhoneCategoryId,
                'vendor' => 'APPLE',
                'props' => [
                    'main_image' => '3D-model-iphone-x_600.jpg',
                    'price' => 69999,
                    'reviews' => [
                        [
                            'name' => 'Екатерина',
                            'comment' => 'Покупкой довольная, работает на ура. Доставили курьером быстро.',
                        ],
                        [
                            'name' => 'Мария',
                            'comment' => 'Отличный телефон, без нареканий. Соответствует описанию и ожиданиям.',
                        ],
                        [
                            'name' => 'Катя',
                            'comment' => 'Отличная модель. Все что нужно есть, все работает превосходно. Мне очень нравится!',
                        ],
                        [
                            'name' => 'Алексей',
                            'comment' => 'Хороший скоростной смартфон, наверное на данный момент уже нет смысла перечислять все плюсы.',
                        ],
                        [
                            'name' => 'Валентин',
                            'comment' => 'Через неделю перестал работать Face ID',
                        ],
                        [
                            'name' => 'Роман',
                            'comment' => 'Все на 5-ку. В общем как всегда, айфон на высоте.',
                        ],
                        [
                            'name' => 'Павел',
                            'comment' => 'Компактный по размеру, стильно выглядит. Памяти вполне хватает. Экран качественный. Яблочная операционная система с хорошей защитой от вирусов.',
                        ],
                        [
                            'name' => 'Герман',
                            'comment' => 'Хороший телефон. Отличная камера! Быстрый, удобный.',
                        ],
                    ]
                ],
            ],
            [
                'title' => 'Xiaomi Redmi Note 9',
                'slug' => Str::slug('Xiaomi Redmi Note 9'),
                'description' => 'Основная квадрокамера, достойный процессор, поддержка быстрой зарядки и NFC для бесконтактных платежей.',
                'category_id' => $smartPhoneCategoryId,
                'vendor' => 'XIAOMI',
                'props' => [
                    'main_image' => 'Xiaomi-Redmi-9.jpg',
                    'price' => 45000,
                    'reviews' => [
                        [
                            'name' => 'Екатерина',
                            'comment' => 'Хороший телефон за свои деньги.',
                        ],
                        [
                            'name' => 'Мария',
                            'comment' => 'Быстрый Удобный Лёгок в управлении Держит заряд очень хорошо.',
                        ],
                        [
                            'name' => 'Катя',
                            'comment' => 'Отличная модель. Все что нужно есть, все работает превосходно. Мне очень нравится!',
                        ],
                        [
                            'name' => 'Алексей',
                            'comment' => 'все хорошо.Обновился до 12 0.10.0.Все летает.Уже как год как купил.',
                        ],
                        [
                            'name' => 'Валентин',
                            'comment' => 'мощная АКБ, не такой здоровый, в руке помещается, быстрый, да и камера отличная.',
                        ],
                        [
                            'name' => 'Роман',
                            'comment' => 'Сравнивать с дорогими флагманоми эток т.за50 не стоит.Но некоторые блогеры это делают и он как бы совсем плохой.',
                        ],
                        [
                            'name' => 'Павел',
                            'comment' => 'К покупке не рекомендую - выброшенные деньги.',
                        ],
                        [
                            'name' => 'Герман',
                            'comment' => 'Хороший телефон. Отличная камера! Быстрый, удобный.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Samsung Galaxy Note 9',
                'slug' => Str::slug('Samsung Galaxy Note 9'),
                'description' => 'Гарантирует надежную работу от одного заряда в течение двух дней благодаря повышенной емкости аккумулятора, равной 4000 мА ч.',
                'category_id' => $smartPhoneCategoryId,
                'vendor' => 'SAMSUNG',
                'props' => [
                    'main_image' => 'Galaxy-Note-9.jpg',
                    'price' => 74599,
                    'reviews' => [
                        [
                            'name' => 'Андрей',
                            'comment' => 'Впечатления от этого телефона очень классные, мне все нравится, пока проблем ни с чем не было.',
                        ],
                        [
                            'name' => 'Алексей',
                            'comment' => 'Отличный телефон, пользуюсь чуть более месяца. Быстрый, удобная система распознавания (лицо или отпечаток) по эргономике тоже на высоте. Ждал когда разочарует, но не разочаровал (раньше был samsung s6)',
                        ],
                        [
                            'name' => 'Антон',
                            'comment' => 'Достоинства его бесспорны. Даже сегодня этот девайс является во многих моментах лидером.',
                        ],
                        [
                            'name' => 'Максим',
                            'comment' => 'Мощный процессор, супер камера, влагозащита',
                        ],
                        [
                            'name' => 'Александра',
                            'comment' => 'Три года назад приобрел этот смартфон. До сих пор не вижу смсла менять. Правда пол года назад батарейка стала садиться быстрее и 10 вечера остается 15 процентов',
                        ],
                        [
                            'name' => 'Юлия',
                            'comment' => 'Отличный телефон. Пользуюсь недавно. Невысокая стоимость. Покупал в МВидео по утилизации.',
                        ],
                        [
                            'name' => 'Владимир',
                            'comment' => 'Мощный процессор, огромная диагональ, стилус, камера, батарея 4000 мА/ч',
                        ],
                        [
                            'name' => 'Антонина',
                            'comment' => 'Приятен в использовании, однозначно рекомендую к покупке.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'iMac',
                'slug' => Str::slug('iMac'),
                'description' => 'Моноблочный персональный компьютер, созданный корпорацией Apple.',
                'category_id' => $pcCategoryId,
                'vendor' => 'APPLE',
                'props' => [
                    'main_image' => '27-Inch-iMac-2020.jpg',
                    'price' => 139500,
                    'reviews' => [
                        [
                            'name' => 'Андрей',
                            'comment' => 'Это лучший монитор для работы с медиа контентом. Графикой, видео и фотографией. Все что мне необходимо - запускается без проблем. Все редакторы для фото и видео работают быстро, если снабдить комп SSD и достаточным количеством оперативы, то скорость работы увеличься в разы.',
                        ],
                        [
                            'name' => 'Нина',
                            'comment' => 'Превосходный экран и звук, вместительные аккумуляторы у клавиатуры и мыши, macOS.',
                        ],
                        [
                            'name' => 'Мария',
                            'comment' => 'вентилятор на минимальных оборотах слышно, можно было сделать медленней',
                        ],
                        [
                            'name' => 'Павел',
                            'comment' => 'Монолитный крепкий корпус , классная клавиатура и мышь ,офигенная операционная система ,монитор с разрешением 5к очень удобно работать , бесшумная работа даже в сложных приложениях .',
                        ],
                        [
                            'name' => 'Никита',
                            'comment' => 'Большой монитор, чёткий и яркий дисплей, высокое разрешение, хороший звук.',
                        ],
                        [
                            'name' => 'Екатерина',
                            'comment' => 'Все прекрасно с этим iMac. Качество картинки, возможность апгрейда, производительность.',
                        ],
                        [
                            'name' => 'Максим',
                            'comment' => 'Покупал моноблок. Очень качественный товар. Пришёл быстро. Качество картинки супер. Горантия большая.',
                        ],
                        [
                            'name' => 'Елена',
                            'comment' => 'За такие деньги железо можно и мощнее!',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'RedmiBook Air 13',
                'slug' => Str::slug('RedmiBook Air 13'),
                'description' => 'Легкий и компактный 13-дюймовый ноутбук в ультратонком металлическом корпусе.',
                'category_id' => $pcCategoryId,
                'vendor' => 'XIAOMI',
                'props' => [
                    'main_image' => 'redmibook-logo-image.png',
                    'price' => 68000,
                    'reviews' => [
                        [
                            'name' => 'Константин',
                            'comment' => 'Компания,которая ворвалась на мировый рынок! Модель сопоставима с более дорогими известными брендами,но цена радует. Вообще соотношение цена и качество полностью себя оправдывает.',
                        ],
                        [
                            'name' => 'Анастасия',
                            'comment' => 'компактный, легкий. Хороший экран.',
                        ],
                        [
                            'name' => 'Сюзанна',
                            'comment' => 'однозначно рекомендую к покупке, покупал на старте продаж за 42000 рублей, в РФ покупать технику крайне не рекомендую, так как нужно заморочиться, чтобы найти хорошую скидку',
                        ],
                        [
                            'name' => 'Роман',
                            'comment' => 'Хороший ноутбук, быстрый, справляется с тяжелыми программами. Легкий, тонкий, время автономной работы достаточно большое. Звук гораздо лучше чем у подобных моделей известных фирм. Качество изображение отличное.',
                        ],
                        [
                            'name' => 'Артур',
                            'comment' => 'Греется. Шумит как скотина. Wifi после спящего не подключается. Корявый в принципе. Садится очень быстро. Нафиг.',
                        ],
                        [
                            'name' => 'Игорь',
                            'comment' => 'У брата такой, пока всем доволен. Единственное - хлипковат на вид и боясь недолго он у него продержится)',
                        ],
                        [
                            'name' => 'Сергей',
                            'comment' => 'Этот ноутбук просто офигенный,несмотря на его компактность, он содержит мощнейший процесор и видеокарту, на нем пойдут неплохие игры,да и для работы он просто идеален!',
                        ],
                        [
                            'name' => 'Иоанн',
                            'comment' => 'Прекрасный экран, яркий и насыщенный',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Galaxy Book S',
                'slug' => Str::slug('Galaxy Book S'),
                'description' => 'Тонкий суперлегкий ноутбук в стильном и практичном корпусе из матового алюминия.',
                'category_id' => $pcCategoryId,
                'vendor' => 'SAMSUNG',
                'props' => [
                    'main_image' => 'Galaxy-Book-S.jpg',
                    'price' => 66999,
                    'reviews' => [
                        [
                            'name' => 'Константин',
                            'comment' => 'Очень красивый, лаконичный и мощный.',
                        ],
                        [
                            'name' => 'Анастасия',
                            'comment' => 'Яркий экран, мощный процессор и видеокарта, подсветка клавиатуры.',
                        ],
                        [
                            'name' => 'Сюзанна',
                            'comment' => 'Брала себе для работы и для игр, справляется на все 100%.',
                        ],
                        [
                            'name' => 'Роман',
                            'comment' => 'Покупал для работы ну и поиграть в игрушки разные, пока всем доволен все тянет для моих потребностей',
                        ],
                        [
                            'name' => 'Артур',
                            'comment' => 'Новое программное обеспечение намного производительнее, работа стала в 2 раза быстрее ,всем советую кто работает с графикой.',
                        ],
                        [
                            'name' => 'Игорь',
                            'comment' => 'Легкий для игрового ноутбука',
                        ],
                        [
                            'name' => 'Сергей',
                            'comment' => 'Процессор 11 поколения, стильный, удобный, тонкий.',
                        ],
                        [
                            'name' => 'Иоанн',
                            'comment' => 'Характеристики и цена.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'AirPods Pro',
                'slug' => Str::slug('AirPods Pro'),
                'description' => 'Невероятно лёгкие наушники с функцией шумоподавления.',
                'category_id' => $headphonesCategoryId,
                'vendor' => 'APPLE',
                'props' => [
                    'main_image' => 'airpods.jpeg',
                    'price' => 20000,
                    'reviews' => [
                        [
                            'name' => 'Константин',
                            'comment' => 'Шикарное шумоподавление',
                        ],
                        [
                            'name' => 'Анастасия',
                            'comment' => 'Одно ухо постоянно выпадает во время тренировок.',
                        ],
                        [
                            'name' => 'Сюзанна',
                            'comment' => 'Супер звук, супер эффекты, особенно шумоподавление. Очень ярко это ощущается в самолёте! Шум практически уходит, и что самое главное не слышно орущих детишек!!!!',
                        ],
                        [
                            'name' => 'Роман',
                            'comment' => 'Шумодав очень крутая штука! Все, плюсы закончились. Больше ничего необычного по сравнению с обычными AirPods не заметил.',
                        ],
                        [
                            'name' => 'Артур',
                            'comment' => 'При разговоре по телефону нужно кричать чтобы собеседник слышал',
                        ],
                        [
                            'name' => 'Игорь',
                            'comment' => 'Отличные наушники для каждодневного использования с YouTube, фильмов, разговоров по телефону.',
                        ],
                        [
                            'name' => 'Сергей',
                            'comment' => 'Отличный звук, шумодав, быстрый коннект с эппл',
                        ],
                        [
                            'name' => 'Игнат',
                            'comment' => 'Очень рад, что купил наушники за 12 т.р. (Со скидками от маркета и бонусами спасибо). 20000 они точно не стоят.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Mi True Wireless Earbuds Basic 2',
                'slug' => Str::slug('Mi True Wireless Earbuds Basic 2'),
                'description' => 'Прекрасный альянс эргономики и функционала.',
                'category_id' => $headphonesCategoryId,
                'vendor' => 'XIAOMI',
                'props' => [
                    'main_image' => 'o1605203616.jpg',
                    'price' => 5000,
                    'reviews' => [
                        [
                            'name' => 'Константин',
                            'comment' => 'Надёжные, не большие, хорошо держат заряд',
                        ],
                        [
                            'name' => 'Анастасия',
                            'comment' => 'Нет провода зарядки в комплекте!',
                        ],
                        [
                            'name' => 'Сюзанна',
                            'comment' => 'Приятный звук, аккумуляторов хватает надолго.',
                        ],
                        [
                            'name' => 'Роман',
                            'comment' => 'Микрофон хороший только если вокруг тихо, в остальных случаях собеседник будет сылшать все, кроме вас.',
                        ],
                        [
                            'name' => 'Артур',
                            'comment' => 'Можно было аккумулятор побольше поставить',
                        ],
                        [
                            'name' => 'Игорь',
                            'comment' => 'маленькие, легкие. маленький кейс',
                        ],
                        [
                            'name' => 'Сергей',
                            'comment' => 'Один раз потерял связь с левым наушником. Решение : зажать кнопку на наушники и не отпуская вложить в кейс для зарядки. Загорится красный индикатор.',
                        ],
                        [
                            'name' => 'Игнат',
                            'comment' => 'При длительном ношении начинают немного побаливать уши.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'True Wireless Samsung Galaxy Buds Pro Black',
                'slug' => Str::slug('True Wireless Samsung Galaxy Buds Pro Black'),
                'description' => 'Беспроводные наушники с технологиями профессионального уровня.',
                'category_id' => $headphonesCategoryId,
                'vendor' => 'SAMSUNG',
                'props' => [
                    'main_image' => '50148100b.jpg',
                    'price' => 17000,
                    'reviews' => [
                        [
                            'name' => 'Константин',
                            'comment' => 'Вполне приличный звук для TWS.',
                        ],
                        [
                            'name' => 'Анастасия',
                            'comment' => 'Приличный звук. Хорошее шумоподавление. Удивительно, но пока из ушей не выпадают',
                        ],
                        [
                            'name' => 'Сюзанна',
                            'comment' => 'Полный функционал и качество разворачивается с телефонами Samsung, что и логично.',
                        ],
                        [
                            'name' => 'Роман',
                            'comment' => 'Звук отличный,заряд держат хорошо.',
                        ],
                        [
                            'name' => 'Артур',
                            'comment' => 'Щикарное качество звука и сборки. В этой ценовой категории это одни из лидеров на рынке.',
                        ],
                        [
                            'name' => 'Игорь',
                            'comment' => 'Хороший звук, удобные',
                        ],
                        [
                            'name' => 'Сергей',
                            'comment' => 'Качество звука, глубокий бас, удобно сидят в ушах и футуристичный дизайн',
                        ],
                        [
                            'name' => 'Игнат',
                            'comment' => 'Понравилось управление с телефона: много полезных, удобных настроек. Звук: за эти деньги - твёрдое 5!',
                        ],
                    ],
                ],
            ],
        ];

        $faker = \Faker\Factory::create();

        foreach ($products as $product) {
            $shuffledSellers = $sellers->shuffle();
            $props = array_pop($product);
            $mainImage = $props['main_image'];
            $mainImage = $this->makeImage($mainImage, $imgDir, $userId);

            $images = $props['images'] ?? [];
            $images = $this->makeImages($images, $imgDir, $userId);

            $product['main_image_id'] = $mainImage->id;

            /** @var Product $product */
            $product = Product::factory()->create($product);

            for ($i = 0; $i < 2; $i++) {
                $product->sellers()->attach(
                    $shuffledSellers->get($i)->id,
                    ['price' => $props['price'] + rand(-(int) $props['price'] / 2, (int) $props['price'] / 2)]
                );
            }

            $product->images()->saveMany($images);

            foreach ($props['specifications'] ?? [] as $spec => $val) {
                $specId = Specification::where('slug', $spec)->first()->id;
                $product->specifications()
                    ->attach($specId, ['value' => $val]);
            }

            foreach ($props['reviews'] ?? [] as $review) {
                $review['email'] = $faker->email;
                $review['created_at'] = $faker->dateTimeThisMonth();
                $product->reviews()->create($review);
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
