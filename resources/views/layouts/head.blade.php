{{--Шаблон head--}}
<head>
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link href="/favicon.ico" rel="shortcut icon">

    <link rel="stylesheet" href="{{ mix('/assets/css/app.css') }}">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
