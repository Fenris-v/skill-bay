@props(['submit' => null, 'method' => 'get'])
<form method="{{ $method !== 'get' ? 'post' : 'get' }}" {{ $attributes }}>
    @csrf
    <input type="hidden" name="_method" value="{{ $method }}">
    {{ $slot }}
    {{ $submit }}
</form>