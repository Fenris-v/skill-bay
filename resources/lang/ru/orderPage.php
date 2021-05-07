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
            'fullName' => ['label' => 'ФИО', 'placeholder' => 'Ваше ФИО'],
            'phone' => ['label' => 'Телефон', 'placeholder' => '+70000000000'],
            'email' => ['label' => 'E-mail', 'placeholder' => 'client@example.com'],
            'password' => ['label' => 'Пароль', 'placeholder' => 'Тут можно изменить пароль'],
            'confirmPassword' => ['label' => 'Подтверждение пароля', 'placeholder' => 'Введите пароль повторно'],
        ],
        'delivery' => [
            'city' => ['label' => 'Город', 'placeholder' => 'Город доставки'],
            'address' => ['label' => 'Адрес', 'placeholder' => 'Адрес доставки'],
        ],
    ],
    'buttons' => [
        'next' => 'Дальше',
        'login' => 'Я уже зарегистрирован',
    ],
    'errors' => [
        'userAlreadyExists' => 'Пользователь с указанным Email существует, вы можете авторизоваться'
    ],

];