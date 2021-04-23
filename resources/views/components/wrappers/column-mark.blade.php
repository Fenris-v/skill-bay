@props(['icon'])
<div class="Section-columnSection Section-columnSection_mark">
    <div class="media media_middle">
        <div class="media-image">
            <x-dynamic-component :component="$icon" />
        </div>
        <div class="media-content">
            {{ $slot }}
        </div>
    </div>
</div>