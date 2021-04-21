{{--Меню навигации в хэдере--}}
<div class="menuModal" id="navigate">
    <ul class="menu menu_main">
        <li class="menu-item">
            <a class="menu-link" href="{{ route('index') }}">{{ __('navigation.main') }}</a>
        </li>
        <li class="menu-item">
            <span class="menu-label menu-label_danger">Hot</span>
            <a class="menu-link" href="{{ route('products.index') }}">{{ __('navigation.catalog') }}</a>
        </li>
        <li class="menu-item">
            <span class="menu-label menu-label_success">New</span>
            <a class="menu-link" href="sale.html">{{ __('navigation.discounts') }}</a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="contacts.html">{{ __('navigation.contacts') }}</a>
        </li>
    </ul>
</div>
