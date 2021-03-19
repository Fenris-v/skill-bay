{{--Заголовок с линией--}}
<header class="{{ isset($class) ? $class : 'Section-header' }}">
    <h2 class="Section-title">{{ $title ?? '' }}</h2>

    @isset($isSlider)
        <div class="Section-control">
            <div class="Slider-navigate"></div>
        </div>
    @endisset
</header>
