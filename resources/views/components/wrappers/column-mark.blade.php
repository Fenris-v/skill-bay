@props(['src', 'alt'])
<div class="Section-columnSection Section-columnSection_mark">
    <div class="media media_middle">
        <div class="media-image">
            <img src="{{ $src }}" alt="{{ $alt }}"/>
        </div>
        <div class="media-content">
            {{ $slot }}
        </div>
    </div>
</div>