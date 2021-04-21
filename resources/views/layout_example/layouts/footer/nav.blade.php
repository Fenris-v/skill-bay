{{--Меню в футере--}}
<div class="row-block">
    <strong class="Footer-title">{{ $title ?? '' }}</strong>
    <ul class="menu menu_vt Footer-menu">
        @foreach($menu as $item)
            <li class="menu-item">
                <a class="menu-link" href="{{ $item['link'] ?? '#' }}">{{ $item['name'] ?? '' }}</a>
            </li>
        @endforeach
    </ul>
</div>
