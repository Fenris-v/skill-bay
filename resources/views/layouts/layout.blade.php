{{--Входной шаблон--}}
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

    @yield('content')

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
