{{--Слайдер на главной вверху--}}
<div class="Header-slider">
    <div class="Slider Slider_main">
        <div class="Slider-box">
            @each('pages.main.top_slide', $banners, 'banner')
        </div>

        <div class="Slider-navigateWrap">
            <div class="Slider-navigate">
            </div>
        </div>
    </div>
</div>
