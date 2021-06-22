<?php

use App\Orchid\Layouts\Discount\ProductTypeDiscountLayout;
use App\Orchid\Layouts\Discount\GroupTypeDiscountLayout;
use App\Orchid\Layouts\Discount\CartTypeDiscountLayout;

/**
 * Языковые константы админ панели
 */
return [
    'change' => 'Изменить',
    'delete' => 'Удалить',
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
        ],
    ],
    'product' => [
        'general' => 'Основное',
        'sellers' => 'Продавцы',
        'seller' => 'Продавец',
        'sellers_edit' => 'Добавить/удалить продавцов',
        'specifications_edit' => 'Добавить/удалить характеристики',
        'seller_added' => 'Продавец добавлен. Не забудьте изменить цену',
        'specification_edited' => 'Характеристики изменены',
        'price' => 'Цена продавца :seller',
        'specifications' => 'Характеристики',
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
                'avg_price' => 'Средняя цена',
                'updated' => 'Обновлено',
                'rating_sort' => 'Сортировка',
            ],
            'buttons' => [
                'add' => 'Добавить товар',
            ],
        ],
        'edit' => [
            'title_create' => 'Создание товара',
            'title_edit' => 'Редактирование ":title" #:id',
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
            'description' => 'Описание',
            'category' => 'Категория',
            'no_category' => 'Без категории',
            'image' => 'Изображение',
            'images' => 'Изображения',
        ],
    ],
    'product-review' => [
        'was_deleted' => 'Отзыв был удален',
        'product-reviews' => 'Отзывы к товарам',
        'list' => [
            'title' => 'Список отзывов к товарам',
            'description' => 'Просмотр и управление отзывами',
            'table' => [
                'id' => 'ID',
                'comment' => 'Отзыв',
                'product' => 'Товар',
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
        'was_deleted' => 'Баннер был удален',
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
                'create' => 'Сохранить',
                'edit' => 'Сохранить',
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
    'category' => [
        'was_deleted' => 'Категория была удалена',
        'categories' => 'Категории товаров',
        'list' => [
            'title' => 'Список категорий товаров',
            'description' => 'Просмотр и управление категориями товаров',
            'table' => [
                'id' => 'ID',
                'title' => 'Наименование',
            ],
            'buttons' => [
                'add' => 'Добавить категорию',
            ],
        ],
        'edit' => [
            'title_edit' => 'Редактирование категории ":name"',
            'title_create' => 'Создание категории',
            'success_edit' => 'Вы успешно изменили категорию ":name"',
            'remove_edit' => 'Категорию №":name" удалена',
            'buttons' => [
                'edit' => 'Сохранить',
                'create' => 'Создать категорию',
                'remove' => 'Удалить категорию',
            ],
            'labels' => [
                'name' => 'Название категории',
                'icon' => 'Иконка',
                'parent' => 'Родительская категория',
                'parent_empty' => 'Нет родителя',
                'is_hot' => 'Горячая категория',
                'hot_order' => 'Положение среди других горячих категорий',
                'hot_order_tip' => 'Может быть от 0 до 100',
                'image' => 'Изображение',
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
    'categories' => 'Категории',
    'products' => [
        'id' => 'ID',
        'title' => 'Название',
        'avg_price' => 'Средняя цена',
        'edit' => 'Редактировать',
        'delete' => 'Удалить',
        'deleted' => 'Продукт был удален',
    ],
    'actions' => 'Действия',
    'users' => 'Пользователи',
    'discount' => [
        'title' => 'Скидки',
        'group' => 'Набор №:number',
        'chooseProducts' => 'Выберите товары',
        'chooseCategories' => 'Выберите категории',
        'changeAmountGroup' => 'Изменить количество наборов',
        'requiredTab' => 'Обязательные параметры',
        'relationTab' => 'Связи',
        'optionalTab' => 'Необязательные параметры',
        'types' => [
            '1' => 'На товары',
            '2' => 'На наборы',
            '3' => 'На корзину',
        ],
        'unit_types' => [
            '1' => '%',
            '2' => '$',
        ],
        'list' => [
            'title' => 'Список скидок',
            'description' => 'Просмотр и управление скидками',
            'table' => [
                'id' => 'ID',
                'title' => 'Название',
                'value' => 'Размер',
                'description' => 'Описание',
                'begin_at' => 'Действует с',
                'end_at' => 'Заканчивается с',
                'type' => 'Тип',
                'priority' => 'Приоритет',
            ],
            'buttons' => [
                'add' => 'Добавить скидку',
            ]
        ],
        'edit' => [
            'title_edit' => 'Редактирование скидки :name',
            'title_create' => 'Создание новой скидки',
            'remove_edit' => 'Скидка :name успешно удалена',
            'success_create' => 'Скидка :name создана',
            'success_edit' => 'Вы успешно изменили информацию о скидке :name',
            'buttons' => [
                'save' => 'Сохранить',
                'remove' => 'Удалить скидку',
                'create' => 'Создать',
            ],
            'labels' => [
                'title' => 'Название',
                'value' => 'Размер',
                'description' => 'Описание',
                'begin_at' => 'Действует с',
                'end_at' => 'Заканчивается с',
                'type' => 'Тип',
                'unit_type' => 'Способ расчета',
                'priority' => 'Приоритет',
                'image' => 'Изображение',
            ],
            'conditions' => [
                'max_price' => 'Макимальная цена товаров в корзине',
                'min_price' => 'Минимальная цена товаров в корзине',
                'max_amount' => 'Макимальное количество товаров в корзине',
                'min_amount' => 'Минимальное количество товаров в корзине',
            ],
        ],
    ],
];
