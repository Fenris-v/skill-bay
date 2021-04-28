{{--Блок сортировки--}}
@if($sortProps)
    <div class="Sort">
        <div class="Sort-title">{{ __('catalog.sort-by') }}:</div>
        <div class="Sort-variants">
            @foreach($sortProps as $name => $prop)
                <a class="Sort-sortBy {{ $prop['class'] }}" href="{{ $prop['href'] }}">
                    {{ __("catalog.by-$name") }}
                </a>
            @endforeach
        </div>
    </div>
@endif
