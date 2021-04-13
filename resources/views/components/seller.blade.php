@props(['seller'])
<div class="Section-column">
    <x-wrappers.column-mark
            src="/assets/img/icons/contacts/phone.svg"
            alt="phone.svg"
    >
        Тел:&#32;<nobr>{{ $seller->phone }}</nobr>
    </x-wrappers.column-mark>
    <x-wrappers.column-mark
            src="/assets/img/icons/contacts/address.svg"
            alt="address.svg"
    >
        {{ $seller->address }}
    </x-wrappers.column-mark>
    <x-wrappers.column-mark
            src="/assets/img/icons/contacts/mail.svg"
            alt="mail.svg"
    >
        Email: {{ $seller->email }}
    </x-wrappers.column-mark>
</div>
<div class="Section-content">
    <x-wrappers.row class="row_verticalCenter row_maxHalf">
        <x-wrappers.row-block>
            <div class="pict">
                <img src="/assets/img/content/home/bigGoods.png" alt="bigGoods.png"/>
            </div>
        </x-wrappers.row-block>
        <x-wrappers.row-block>
            <h2>{{ $seller->title }}</h2>
            <p>{{ $seller->description }}</p>
        </x-wrappers.row-block>
    </x-wrappers.row>
    {{ $slot }}
</div>
