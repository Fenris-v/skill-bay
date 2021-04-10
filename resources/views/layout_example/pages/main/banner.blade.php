{{--Баннер на главной--}}
<a class="BannersHomeBlock" href="{{ $banner['link'] ?? '#' }}">
    <div class="BannersHomeBlock-row">
        <div class="BannersHomeBlock-block">
            <strong class="BannersHomeBlock-title">
                {{ $banner['name'] }}
            </strong>
            <div class="BannersHomeBlock-content">{!! $banner['description'] ?? ''  !!}</div>
        </div>
        <div class="BannersHomeBlock-block">
            <div class="BannersHomeBlock-img">
                <img src="{{ $banner['img'] }}" alt="{{ $banner['img'] ?? '' }}"/>
            </div>
        </div>
    </div>
</a>
