{{--Шаблон head--}}
<!DOCTYPE html><!--[if IE 7]>
<html class="ie7" lang="ru">
<![endif]-->
<!--[if IE 8]>
<html class="ie8" lang="ru">
<![endif]-->
<!--[if IE 9]>
<html class="ie9" lang="ru">
<![endif]-->
<!--[if IE 10]>
<html class="ie10" lang="ru">
<![endif]-->
<!--[if IE 11]>
<html class="ie11" lang="ru">
<![endif]-->
<!--[if gt IE 11]><!-->
<html lang="ru"> <!--<![endif]-->
<head>
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link href="/favicon.ico" rel="shortcut icon">
    <link rel="preload" href="/assets/fonts/Roboto/Roboto-Regular.woff" as="font">
    <link rel="preload" href="/assets/fonts/Roboto/Roboto-Italic.woff" as="font">
    <link rel="preload" href="/assets/fonts/Roboto/Roboto-Bold.woff" as="font">
    <link rel="preload" href="/assets/fonts/Roboto/Roboto-Bold_Italic.woff" as="font">
    <link rel="preload" href="/assets/fonts/Roboto/Roboto-Light.woff" as="font">
    <link rel="preload" href="/assets/fonts/Roboto/Roboto-Light_Italic.woff" as="font">
    <link rel="stylesheet" href="{{ mix('/assets/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ mix('/assets/css/basic.css') }}">
    <link rel="stylesheet" href="{{ mix('/assets/css/extra.css') }}">
    <script src="/assets/plg/CountDown/countdown.js"></script>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
