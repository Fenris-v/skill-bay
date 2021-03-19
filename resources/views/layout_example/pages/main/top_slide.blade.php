<div class="Slider-item">
    <div class="Slider-content">
        <div class="row">
            <div class="row-block">
                <strong class="Slider-title">
                    {!! $banner['name'] !!}
                </strong>
                <div class="Slider-text">
                    {{ $banner['description'] ?? '' }}
                </div>
                <div class="Slider-footer">
                    <a class="btn btn_primary"
                       href="{{ $banner['link'] }}">{{ $banner['link_text'] }}</a>
                </div>
            </div>
            <div class="row-block">
                <div class="Slider-img">
                    <img src="{{ $banner['img'] }}" alt="{{ $banner['alt'] ?? '' }}"/>
                </div>
            </div>
        </div>
    </div>
</div>
