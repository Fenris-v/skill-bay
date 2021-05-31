<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute должен быть принят',
    'active_url' => ':attribute не валидный URL.',
    'after' => ':attribute должен быть датой после :date.',
    'after_or_equal' => ':attribute должен быть датой после или равной :date.',
    'alpha' => ':attribute должен содержать только буквы',
    'alpha_dash' => ':attribute может содержать только буквы, цифры, тире и подчеркивания.',
    'alpha_num' => ':attribute может содержать только буквы и цифры.',
    'array' => ':attribute должно быть, массивом.',
    'before' => ':attribute должен быть датой до :date.',
    'before_or_equal' => ':attribute должен быть датой до или равной :date.',
    'between' => [
        'numeric' => ':attribute должен быть между :min и :max.',
        'file' => ':attribute должен быть между :min и :max килобайтов.',
        'string' => ':attribute должен быть между :min и :max символов.',
        'array' => ':attribute должен быть между :min and :max элементами.',
    ],
    'boolean' => ':attribute поля должен быть истинным или ложным.',
    'confirmed' => ':attribute подтверждение не совпадает.',
    'date' => ':attribute невалидная дата',
    'date_equals' => ':attribute должна быть дата, равная :date.',
    'date_format' => ':attribute не соответствует формату :format.',
    'different' => ':attribute и :other должны отличаться.',
    'digits' => ':attribute должен содержать :digits цифр.',
    'digits_between' => ':attribute должен быть между :min и :max digits.',
    'dimensions' => ':attribute имеет недопустимые размеры изображения.',
    'distinct' => ':attribute поле имеет повторяющееся значение.',
    'email' => ':attribute должен быть валидным email адресом.',
    'ends_with' => ':attribute должно заканчиваться одним из следующих: :values.',
    'exists' => 'выбранный :attribute не существует',
    'file' => ':attribute должен быть файлом.',
    'filled' => ':attribute поле должно иметь значение.',
    'gt' => [
        'numeric' => ':attribute должно быть больше, чем :value.',
        'file' => ':attribute должно быть больше, чем :value килобайтов.',
        'string' => ':attribute должно быть больше, чем :value символов.',
        'array' => ':attribute должно быть больше, чем :value элементов.',
    ],
    'gte' => [
        'numeric' => ':attribute должно быть больше или равно :value.',
        'file' => ':attribute должно быть больше или равно :value килобайтов.',
        'string' => ':attribute должно быть больше или равно :value символов.',
        'array' => ':attribute должно быть :value элементов или больше.',
    ],
    'image' => ':attribute должен быть изображением.',
    'in' => 'Выбранный :attribute не корректен.',
    'in_array' => ':attribute поле не существует в :other.',
    'integer' => ':attribute должен быть числом.',
    'ip' => ':attribute должен быть действительный IP-адрес.',
    'ipv4' => ':attribute должен быть действительный IPv4 адрес.',
    'ipv6' => ':attribute должен быть действительный IPv6 адрес.',
    'json' => ':attribute должна быть действительная JSON строка.',
    'lt' => [
        'numeric' => ':attribute должно быть меньше, чем :value.',
        'file' => ':attribute должно быть меньше, чем :value килобайтов.',
        'string' => ':attribute должно быть меньше, чем :value символов.',
        'array' => ':attribute должно быть меньше, чем :value элементов.',
    ],
    'lte' => [
        'numeric' => ':attribute должно быть меньше или равно :value.',
        'file' => ':attribute должно быть меньше или равно :value килобайтов.',
        'string' => ':attribute должно быть меньше или равно :value символов.',
        'array' => ':attribute не должно быть больше, чем :value элементов.',
    ],
    'max' => [
        'numeric' => ':attribute не может быть больше, чем :max.',
        'file' => ':attribute не может быть больше, чем :max килобайтов.',
        'string' => ':attribute не может быть больше, чем :max символов.',
        'array' => ':attribute может иметь не более :max элементов.',
    ],
    'mimes' => ':attribute должен быть файл типа: :values.',
    'mimetypes' => 'The :attribute должен быть файл типа: :values.',
    'min' => [
        'numeric' => ':attribute должно быть, по крайней мере :min.',
        'file' => ':attribute должно быть, по крайней мере :min килобайтов.',
        'string' => ':attribute должно быть, по крайней мере :min символов.',
        'array' => ':attribute должно быть, по крайней мере :min элементов.',
    ],
    'multiple_of' => ':attribute должно быть кратно :value.',
    'not_in' => 'Выбранный :attribute не корректен.',
    'not_regex' => ':attribute формат не корректен.',
    'numeric' => ':attribute должен быть числом.',
    'password' => 'Пароль неверен.',
    'present' => ':attribute поле должно присутствовать.',
    'regex' => ':attribute формат не корректен.',
    'required' => ':attribute поле обязательно.',
    'required_if' => ':attribute поле требуется, когда :other является :value.',
    'required_unless' => ':attribute поле обязательно, если только :other находится в :values.',
    'required_with' => ':attribute поле требуется, когда :values присутствует.',
    'required_with_all' => ':attribute поле требуется, когда :values присутствуют.',
    'required_without' => ':attribute поле требуется, когда :values не присутствует.',
    'required_without_all' => ':attribute поле обязательно, если ни один из :values не присутствует.',
    'same' => ':attribute и :other должны совпадать.',
    'size' => [
        'numeric' => ':attribute должен быть размера :size.',
        'file' => ':attribute должен быть :size килобайтов.',
        'string' => ':attribute должно быть :size символов.',
        'array' => ':attribute должен содержать :size элементов.',
    ],
    'starts_with' => ':attribute должен начинаться с одного из следующих: :values.',
    'string' => ':attribute должен быть строкой.',
    'timezone' => ':attribute должна быть допустимая зона.',
    'unique' => ':attribute уже был занят.',
    'uploaded' => ':attribute не удалось загрузить.',
    'url' => ':attribute формат недопустим.',
    'uuid' => ':attribute должен быть корректным UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

    'min.numeric' => 'Переданное значение меньше минимально допустимого',
    'email' => 'Введен неправильный Email'
];

