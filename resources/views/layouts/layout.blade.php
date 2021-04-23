{{--Входной шаблон--}}
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
<!--[if gt IE 11]><!--> <html lang="ru"> <!--<![endif]-->
@include('layouts.head')

<body class="Site">
<!--if lt IE 8
p.error-browser
    | Ваш браузер&nbsp;
    em устарел!&nbsp;
    a(href="http://browsehappy.com/") Выберите новую версию
        +s
        | браузера здесь&nbsp;
    | для правильного отображения сайта.
-->

@include('layouts.header.index')

@hasSection('middle-header-h1')
    <div class="Middle Middle_top">
        <div class="Middle-top">
            <div class="wrap">
                <div class="Middle-header">
                    <h1 class="Middle-title">
                        @yield('middle-header-h1')
                    </h1>
                    <x-wrappers.breadcrumbs />
                </div>
            </div>
            <x-notification />
        </div>
        @yield('content')
    </div>
@else
    <x-notification />
    @yield('content')
@endif

@include('layouts.footer.index')

<!--+Middle-->
<!--    +div.-top-->
<!--        +breadcrumbs('Главная','Портфолио')-->
<!--    +Article('portfolio')-->
<!---->
<script src="{{ mix('/assets/js/manifest.js') }}"></script>
<script src="{{ mix('/assets/js/vendor.js') }}"></script>
<script src="{{ mix('/assets/js/app.js') }}"></script>
</body>
</html>
