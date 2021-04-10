{{--Элемент списка социальных сетей--}}
<li class="menu-item">
    <a class="menu-link" href="{{ $item['link'] ?? '' }}">
        <img src="/assets/img/icons/{{ isset($isFooter) ? 'socialFooter' : 'socialHeader' }}/{{ $item['icon'] ?? '' }}"
             alt="{{ $item['alt'] ?? '' }}"/>
    </a>
</li>
