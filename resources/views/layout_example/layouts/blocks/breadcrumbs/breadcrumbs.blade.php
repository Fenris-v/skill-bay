{{--Хлебные крошки--}}
<div class="Middle-top">
    <div class="wrap">
        <div class="Middle-header">
            <h1 class="Middle-title">{{ $title }}</h1>
            @isset($breadcrumbs)
                <ul class="breadcrumbs Middle-breadcrumbs">
                    @each('layouts.blocks.breadcrumbs.breadcrumb_item', $breadcrumbs, 'breadcrumb')
                </ul>
            @endisset
        </div>
    </div>
</div>
