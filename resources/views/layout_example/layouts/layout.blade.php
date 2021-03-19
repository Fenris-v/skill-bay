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

<div class="Middle {{ url()->current() !== route('index') ? 'Middle_top' : '' }}">
    @yield('content')
</div>

@include('layouts.footer.index')

<!--+Middle-->
<!--    +div.-top-->
<!--        +breadcrumbs('Главная','Портфолио')-->
<!--    +Article('portfolio')-->
<!---->
<script src="/assets/plg/jQuery/jquery-3.5.0.slim.min.js"></script>
<script src="/assets/plg/form/jquery.form.js"></script>
<script src="/assets/plg/form/jquery.maskedinput.min.js"></script>
<script src="/assets/plg/range/ion.rangeSlider.min.js"></script>
<script src="/assets/plg/Slider/slick.min.js"></script>
<script src="/assets/js/scripts.js"></script>
</body>
