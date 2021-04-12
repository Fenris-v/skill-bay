@if ($banners->isNotEmpty())
    <div class="Header-slider">
        <div class="Slider Slider_main">
            <div class="Slider-box">
                @foreach($banners as $banner)
                    <x-banners.banners-item :banner="$banner" />
                @endforeach
            </div>
            <div class="Slider-navigateWrap">
                <div class="Slider-navigate">
                </div>
            </div>
        </div>
    </div>
@endif
