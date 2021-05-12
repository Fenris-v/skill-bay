<div class="Section-column">
    <div class="Section-columnSection">
        <header class="Section-header">
            <strong class="Section-title">{{ __('navigation.navigation') }}</strong>
        </header>
        <div class="Section-columnContent">
            <div class="NavigateProfile">
                <ul class="menu menu_vt">
                    <li class="menu-item {{ url()->current() === route('account') ? 'menu-item_ACTIVE' : '' }}">
                        <a class="menu-link" href="{{ route('account') }}">
                            {{ __('navigation.account') }}
                        </a>
                    </li>
                    <li class="menu-item {{ url()->current() === route('profile') ? 'menu-item_ACTIVE' : '' }}">
                        <a class="menu-link" href="{{ route('profile') }}">
                            {{ __('navigation.profile') }}
                        </a>
                    </li>
                    <li class="menu-item {{ url()->current() === route('orders.index') ? 'menu-item_ACTIVE' : '' }}">
                        <a class="menu-link" href="{{ route('orders.index') }}">
                            {{ __('navigation.orders') }}
                        </a>
                    </li>
                    <li class="menu-item {{ url()->current() === route('viewed_history') ? 'menu-item_ACTIVE' : '' }}">
                        <a class="menu-link" href="{{ route('viewed_history') }}">
                            {{ __('navigation.history') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
