{{--Облако тегов--}}
@php
    $tags = [
        'Video',
        'Development',
        'Gaming',
        'Asus',
        'Development',
        'Video',
    ];
@endphp

<div class="buttons">
    @each('pages.catalog.tags.tag', $tags, 'tag')
</div>
