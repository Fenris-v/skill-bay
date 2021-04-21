@if(Breadcrumbs::has())
    <ul class="breadcrumbs Middle-breadcrumbs">
        @foreach (Breadcrumbs::current() as $crumbs)
            @if ($crumbs->url() && !$loop->last)
                <li class="breadcrumbs-item">
                    <a href="{{ $crumbs->url() }}">
                        {{ $crumbs->title() }}
                    </a>
                </li>
            @elseif($loop->count > 1)
                <li class="breadcrumbs-item breadcrumbs-item_current">
                    <span>{{ $crumbs->title() }}</span>
                </li>
            @endif
        @endforeach
    </ul>
@endif
