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
            'history_size' => 'Количество просмотренных'
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
                'create' => 'Создать товар',
                'edit' => 'Редактировать товар',
            ],
            'labels' => [
                'title' => 'Название',
                'vendor' => 'Производитель',
            ],
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
            'buttons' => [
                'create' => 'Создать баннер',
                'edit' => 'Редактировать баннер',
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
            ],
            'buttons' => [
                'add' => 'Добавить заказ',
            ],
        ],
        'edit' => [
            'title' => 'Редактирование заказа №":id"',
            'success_edit' => 'Вы успешно изменили заказ №":id"',
            'buttons' => [
                'edit' => 'Редактировать заказ',
            ],
        ],
    ],
];
