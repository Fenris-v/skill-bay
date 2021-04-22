@props(['submit' => null])
<form {{ $attributes->merge(['method' => 'get']) }}>
    @csrf
    {{ $slot }}
    {{ $submit }}
</form>