<div class="Section-columnSection">
    <header class="Section-header">
        <strong class="Section-title">{{ __('general.socials') }}</strong>
    </header>
    <div class="Section-columnContent">
        <div class="Footer-payments Footer-payments_column">
            <div>
                <a href="{{ $configs->getFacebook() }}"
                   target="_blank" rel="nofollow noopener">
                    <img src="{{ asset('assets/img/icons/socialContent/fb.png') }}" alt="fb.png"/>
                </a>
            </div>
            <div>
                <a href="{{ $configs->getTwitter() }}"
                   target="_blank" rel="nofollow noopener">
                    <img src="{{ asset('assets/img/icons/socialContent/tw.png') }}" alt="tw.png"/>
                </a>
            </div>
            <div>
                <a href="{{ $configs->getLinkedin() }}"
                   target="_blank" rel="nofollow noopener">
                    <img src="{{ asset('assets/img/icons/socialContent/in.png') }}" alt="in.png"/>
                </a>
            </div>
        </div>
    </div>
</div>
