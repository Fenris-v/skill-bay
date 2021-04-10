<div class="Slider-item">
    <div class="Slider-content">
        <div class="row">
            <div class="row-block">
                <strong class="Slider-title">{{ $banner->title }}</strong>
                @if($banner->description)
                    <div class="Slider-text">{{ $banner->description }}</div>
                @endif
                @if($banner->url)
                    <div class="Slider-footer">
                        <a class="btn btn_primary" href="{{ $banner->url }}">
                            @lang('banner.more')
                        </a>
                    </div>
                @endif
            </div>

            @if($banner->image)
                <div class="row-block">
                    <div class="Slider-img">
                        <img src="{{ $banner->image->getUrl() }}" />
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
