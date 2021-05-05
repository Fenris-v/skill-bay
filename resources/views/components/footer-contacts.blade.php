<div class="row-block">
    @include('layouts.footer.nav_title', ['title' => 'Контакты'])

    <p>{{ __('general.phone') }}: {{ $configs->getPhone() }}<br>
        {{ __('general.email') }}: {{ $configs->getEmail() }}<br>
        {{ __('general.address') }}:
        {!! $configs->getCity() ? $configs->getCity() . '<br>' : '' !!}
        {{ $configs->getAddress() }}</p>
</div>
