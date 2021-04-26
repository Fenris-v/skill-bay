@if ($paginator->hasPages())
    <div class="Pagination">
        <div class="Pagination-ins">
            {{-- Previous Page Link --}}
            @unless ($paginator->onFirstPage())
                <a class="Pagination-element Pagination-element_prev" href="{{ $paginator->previousPageUrl() }}"
                   rel="prev" aria-label="@lang('pagination.previous')">
                    <x-icons.arrows.prev />
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="Pagination-element">
                        <span class="Pagination-text">{{ $element }}</span>
                    </a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="Pagination-element Pagination-element_current">
                                <span class="Pagination-text">{{ $page }}</span>
                            </a>
                        @else
                            <a class="Pagination-element" href="{{ $url }}">
                                <span class="Pagination-text">{{ $page }}</span>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="Pagination-element Pagination-element_prev" href="{{ $paginator->nextPageUrl() }}"
                   rel="prev" aria-label="@lang('pagination.next')">
                    <x-icons.arrows.next />
                </a>
            @endif
        </div>
    </div>
@endif
