@props(['method', 'route', 'product', 'icon', 'formId'])

<form
    method="{{ $method }}"
    action="{{ route($route, $product) }}"
    style="display:none"
    class="Card-btn"
    id="{{ $formId }}">
    @csrf
    {{ $slot }}
</form>

<x-wrappers.icon-link
    :icon="$icon"
    href="#"
    onclick="document.forms['{{ $formId }}'].submit();"
/>
