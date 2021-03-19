{{--Логотип--}}
<a class="logo {{ $class ?? '' }}" href="{{ route('index') }}">
    <img class="logo-image" src="{{ $img ?? '/assets/img/logo.png' }}" alt="logo.png"/>
</a>
