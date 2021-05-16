<?php

/**
 * Языковые константы админ панели
 */
return [
    'lists' => 'Списки',
    'save' => 'Сохранить',
    'config' => [
        'config' => 'Настройки сайта',
        'title' => 'Настройки',
        'screen' => [
            'edit' => [
                'title' => 'Настройки сайта',
                'description' => 'Страница редактирования настроек сайта',
            ],
        ],
        'toasts' => [
            'save' => 'Изменения были сохранены',
            'cache' => 'Кэш очищен'
        ],
        'cache' => [
            'clear' => [
                'all' => 'Очистить весь кэш',
                'catalog' => 'Очистить кэш каталога',
                'configs' => 'Очистить кэш настроек'
            ],
        ],
        'groups' => [
            'config' => 'Настройки',
            'cache' => 'Управление кэшем'
        ],
        'fields' => [
            'per_page' => 'Количество объектов на странице',
            'cache_lifetime' => 'Время жизни кэша',
            'history_size' => 'Количество просмотренных',
            'phone' => 'Телефон',
            'country' => 'Страна',
            'region' => 'Область',
            'city' => 'Город',
            'address' => 'Адрес',
            'email' => 'Email',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'linkedin' => 'Linkedin',
            'about_us' => 'О нас',
            'store_history' => 'Наша история'
        ],
        'contacts' => [
            'title' => 'Контактные данные'
        ]
    ],
    'product' => [
        'products' => 'Товары',
        'list' => [
            'title' => 'Список товаров',
            'description' => 'Просмотр и управление товарами',
            'table' => [
                'id' => 'ID',
                'title' => 'Название',
                'amount' => 'Количество',
                'total_price' => 'Суммарная стоимость (руб.)',
                'seller' => 'Продавец',
            ],
            'buttons' => [
                'add' => 'Добавить товар',
            ],
        ],
        'edit' => [
            'title_create' => 'Создание товара',
            'title_edit' => 'Редактирование ":title"',
            'success_create' => 'Вы успешно создали товар ":title"',
            'success_edit' => 'Вы успешно изменили товар ":title"',
            'buttons' => [
                'save' => 'Сохранить',
            ],
            'labels' => [
                'title' => 'Название',
                'vendor' => 'Производитель',
                'limited' => 'Ограниченный тираж',
            ],
        ],
    ],
    'product-review' => [
        'product-reviews' => 'Отзывы к товарам',
        'list' => [
            'title' => 'Список отзывов к товарам',
            'description' => 'Просмотр и управление отзывами',
            'table' => [
                'id' => 'ID',
                'comment' => 'Отзыв',
            ],
            'buttons' => [
                'add' => 'Добавить отзыв',
            ],
        ],
        'edit' => [
            'title_create' => 'Создание отзыва',
            'title_edit' => 'Редактирование отзыва',
            'success_create' => 'Вы успешно создали отзыв к товару ":product"',
            'success_edit' => 'Вы успешно изменили отзыв к товару ":product"',
            'success_delete' => 'Вы успешно удалили отзыв к товару ":product"',
            'buttons' => [
                'save' => 'Сохранить',
                'remove' => 'Удалить отзыв',
            ],
            'labels' => [
                'name' => 'Автор',
                'email' => 'Email',
                'comment' => 'Отзыв',
            ],
            'select_product' => 'Выберите товар',
        ],
    ],
    'banner' => [
        'banners' => 'Баннеры',
        'list' => [
            'title' => 'Список баннеров',
            'description' => 'Просмотр и управление баннерами',
            'table' => [
                'id' => 'ID',
                'title' => 'Название',
            ],
            'buttons' => [
                'add' => 'Добавить баннер',
            ],
        ],
        'edit' => [
            'title_create' => 'Создание баннера',
            'title_edit' => 'Редактирование ":title"',
            'success_create' => 'Вы успешно создали баннер ":title"',
            'success_edit' => 'Вы успешно изменили баннер ":title"',
            'success_delete' => 'Вы успешно удалили баннер ":title"',
            'buttons' => [
                'create' => 'Создать баннер',
                'edit' => 'Редактировать баннер',
                'remove' => 'Удалить баннер',
            ],
            'labels' => [
                'title' => 'Название',
                'description' => 'Описание',
                'url' => 'URL',
                'image' => 'Изображение',
            ],
        ],
    ],
    'order' => [
        'orders' => 'Заказы',
        'list' => [
            'title' => 'Список заказов',
            'description' => 'Просмотр и управление заказами',
            'table' => [
                'id' => 'ID',
                'delivery_address' => 'Адрес доставки',
                'supplier' => 'Покупатель',
                'delivery_type' => 'Способ доставки',
                'payment_type' => 'Способ оплаты',
                'created_at' => 'Дата и время',
                'actions' => 'Действия',
            ],
            'buttons' => [
                'add' => 'Добавить заказ',
                'show' => 'Просмотр',
            ],
        ],
        'edit' => [
            'title' => 'Редактирование заказа №:id',
            'success_edit' => 'Вы успешно изменили заказ №:id',
            'buttons' => [
                'save' => 'Сохранить',
            ],
            'labels' => [
                'user' => 'Покупатель',
                'delivery_type' => 'Способ доставки',
                'payment_type' => 'Способ оплаты',
                'city' => 'Город доставки',
                'address' => 'Адрес доставки',
                'cart' => 'Корзина',
            ],
        ],
    ],
    'seller' => [
        'title' => 'Продавцы',
        'list' => [
            'title' => 'Список продавцов',
            'description' => 'Просмотр и управление продавцами',
            'table' => [
                'id' => 'ID',
                'title' => 'Название',
                'email' => 'Адрес электронной почты',
                'phone' => 'Номер телефона',
            ],
            'buttons' => [
                'add' => 'Добавить продавца',
            ]
        ],
        'edit' => [
            'title_edit' => 'Редактирование продавца :name',
            'title_create' => 'Создание нового продавца',
            'remove_edit' => 'Продавец :name успешно удален',
            'success_create' => 'Продавец :name создан',
            'success_edit' => 'Вы успешно изменили информацию о продавце :name',
            'buttons' => [
                'save' => 'Сохранить',
                'remove' => 'Удалить продавца',
                'create' => 'Создать',
            ],
            'labels' => [
                'title' => 'Название',
                'phone' => 'Номер телефона',
                'email' => 'Адрес электронной почты',
                'description' => 'Описание',
                'address' => 'Адрес',
                'image' => 'Логитип',
            ],
        ],
    ],
    'callback' => [
        'title' => 'Обратная связь',
        'name' => 'Имя',
        'email' => 'Email',
        'created_at' => 'Отправлено',
        'message' => 'Сообщение',
        'show' => 'Заявка'
    ],
    'back' => 'Назад',
    'users' => 'Пользователи'
];
