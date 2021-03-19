@isset($breadcrumb['link'])
    <li class="breadcrumbs-item">
        <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['name'] }}</a>
    </li>
@else
    <li class="breadcrumbs-item breadcrumbs-item_current">
        <span>{{ $breadcrumb['name'] }}</span>
    </li>
@endisset
