@props(['seller'])
<div class="Section-column">
    <x-wrappers.column-mark icon="icons.contacts.phone">
        {{ __('sellerPage.phone') }}: <nobr>{{ $seller->phone }}</nobr>
    </x-wrappers.column-mark>
    <x-wrappers.column-mark icon="icons.contacts.address">
        {{ __('sellerPage.address') }}: {{ $seller->address }}
    </x-wrappers.column-mark>
    <x-wrappers.column-mark icon="icons.contacts.mail">
        {{ __('sellerPage.email') }}: {{ $seller->email }}
    </x-wrappers.column-mark>
</div>
<div class="Section-content">
    <x-wrappers.row class="row_verticalCenter row_maxHalf">
        <x-wrappers.row-block>
            <div class="pict">
                <img src="{{ $seller->image->getUrl() }}" alt="{{ $seller->image->path }}"/>
            </div>
        </x-wrappers.row-block>
        <x-wrappers.row-block>
            <h2>{{ $seller->title }}</h2>
            <p>{{ $seller->description }}</p>
        </x-wrappers.row-block>
    </x-wrappers.row>
    {{ $slot }}
</div>
