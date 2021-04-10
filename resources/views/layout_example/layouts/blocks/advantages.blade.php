{{--Блок преимуществ--}}
<div class="Section-column">
    <div class="Section-columnSection Section-columnSection_mark">
        <div class="media media_advantage">
            <div class="media-image">
                <img src="/assets/img/icons/advantages/shipping.svg" alt="shipping.svg"/>
            </div>
            <div class="media-content">
                <strong class="media-title">Shipping & Returns</strong>
                <p class="media-text">World wide shipping</p>
            </div>
        </div>
    </div>
    <div class="Section-columnSection Section-columnSection_mark">
        <div class="media media_advantage">
            <div class="media-image"><img src="/assets/img/icons/advantages/moneyBack.svg"
                                          alt="moneyBack.svg"/>
            </div>
            <div class="media-content">
                <strong class="media-title">Money Back
                </strong>
                <p class="media-text">Guaranted payments
                </p>
            </div>
        </div>
    </div>
    <div class="Section-columnSection Section-columnSection_mark">
        <div class="media media_advantage">
            <div class="media-image"><img src="/assets/img/icons/advantages/support.svg"
                                          alt="support.svg"/>
            </div>
            <div class="media-content">
                <strong class="media-title">Support Policy
                </strong>
                <p class="media-text">Fast support team
                </p>
            </div>
        </div>
    </div>
    <div class="Section-columnSection Section-columnSection_mark">
        <div class="media media_advantage">
            <div class="media-image"><img src="/assets/img/icons/advantages/quality.svg"
                                          alt="quality.svg"/>
            </div>
            <div class="media-content">
                <strong class="media-title">Quality Guarantee
                </strong>
                <p class="media-text">Best guaranted items
                </p>
            </div>
        </div>
    </div>

    @if(url()->current() === route('seller'))
        <div class="Section-columnSection Section-columnSection_mark">
            <div class="media media_middle">
                <div class="media-image"><img src="/assets/img/icons/contacts/phone.svg" alt="phone.svg"/>
                </div>
                <div class="media-content">Phone:&#32;
                    <nobr>+8 (200) 800-2000-600</nobr>
                    <br>Mobile:&#32;
                    <nobr>+8 (200) 800-2000-650</nobr>
                </div>
            </div>
        </div>
        <div class="Section-columnSection Section-columnSection_mark">
            <div class="media media_middle">
                <div class="media-image"><img src="/assets/img/icons/contacts/address.svg" alt="address.svg"/>
                </div>
                <div class="media-content">
                    Megano Business Center,
                    0012 United States, Los Angeles
                    Creative Street 15/4
                </div>
            </div>
        </div>
        <div class="Section-columnSection Section-columnSection_mark">
            <div class="media media_middle">
                <div class="media-image"><img src="/assets/img/icons/contacts/mail.svg" alt="mail.svg"/>
                </div>
                <div class="media-content">General: hello@ninzio.com<br>Editor: editor@ninzio.com
                </div>
            </div>
        </div>
    @endif

    @isset($follows)
        @include('layouts.blocks.socials.follow_list', ['follows' => $follows])
    @endisset
</div>
