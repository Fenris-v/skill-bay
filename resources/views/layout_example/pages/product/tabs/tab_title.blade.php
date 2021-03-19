{{--Заголовок таба--}}
<a class="{{ isset($tab['isActive']) ? 'Tabs-link_ACTIVE' : '' }} Tabs-link"
   href="{{ $tab['link'] }}">
    <span>{{ $tab['name'] }}</span>
</a>
