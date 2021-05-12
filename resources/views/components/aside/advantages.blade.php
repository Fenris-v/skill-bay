<div class="Section-column">
    <div class="Section-columnSection Section-columnSection_mark">
        <div class="media media_advantage">
            <div class="media-image">
                <x-icons.advantages.shipping />
            </div>
            <div class="media-content">
                <strong class="media-title">{{ __('general.delivery.title') }}</strong>
                <p class="media-text">{{ __('general.delivery.description') }}</p>
            </div>
        </div>
    </div>
    <div class="Section-columnSection Section-columnSection_mark">
        <div class="media media_advantage">
            <div class="media-image">
                <x-icons.advantages.moneyBack />
            </div>
            <div class="media-content">
                <strong class="media-title">{{ __('general.money_back.title') }}</strong>
                <p class="media-text">{{ __('general.money_back.description') }}</p>
            </div>
        </div>
    </div>
    <div class="Section-columnSection Section-columnSection_mark">
        <div class="media media_advantage">
            <div class="media-image">
                <x-icons.advantages.support />
            </div>
            <div class="media-content">
                <strong class="media-title">{{ __('general.support.title') }}</strong>
                <p class="media-text">{{ __('general.support.description') }}</p>
            </div>
        </div>
    </div>
    <div class="Section-columnSection Section-columnSection_mark">
        <div class="media media_advantage">
            <div class="media-image">
                <x-icons.advantages.quality />
            </div>
            <div class="media-content">
                <strong class="media-title">{{ __('general.quality.title') }}</strong>
                <p class="media-text">{{ __('general.quality.description') }}</p>
            </div>
        </div>
    </div>

    @if(isset($social) && $social)
        <x-socials position="aside" />
    @endif
</div>
