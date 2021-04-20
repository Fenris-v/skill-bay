@if(Breadcrumbs::has())
    <ul class="breadcrumbs Middle-breadcrumbs">
        @foreach (Breadcrumbs::current() as $crumbs)
            @if ($crumbs->url() && !$loop->last)
                <li class="breadcrumbs-item">
                    <a href="{{ $crumbs->url() }}">
                        {{ $crumbs->title() }}
                    </a>
                </li>
            @else
                <li class="breadcrumbs-item breadcrumbs-item_current">
                    <span>{{ $crumbs->title() }}</span>
                </li>
            @endif
        @endforeach
    </ul>
@endif
