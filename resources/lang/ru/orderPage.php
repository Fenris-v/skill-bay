<?php

/**
 * Языковые константы для страницы Оформления заказа
 */
return [
    'metaDescription' => 'Оформление заказа',
    'title' => 'Оформление заказа',
    'progress' => 'Прогресс заполнения',
    'steps' => [
        'personal' => 'ШАГ 1. ПАРАМЕТРЫ ПОЛЬЗОВАТЕЛЯ',
        'delivery' => 'ШАГ 2. СПОСОБ ДОСТАВКИ',
        'payment' => 'ШАГ 3. СПОСОБ ОПЛАТЫ',
        'accept' => 'ШАГ 4. ПОДТВЕРЖДЕНИЕ ЗАКАЗА'
    ],
    'formElements' => [
        'personal' => [
            'fullName' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'confirmPassword' => 'Подтверждение пароля',
        ],
        'delivery' => [
            'city' => 'Город',
            'address' => 'Адрес',
            'type' => 'Тип доставки'
        ],
        'payment' => [
            'type' => 'Оплата'
        ],
    ],
    'buttons' => [
        'next' => 'Дальше',
        'login' => 'Я уже зарегистрирован',
    ],

];