@props(['slots'])
<div class="row row_verticalCenter row_maxHalf">
    @foreach($slots as $slotName)
        <div class="row-block">
            {{ $$slotName }}
        </div>
    @endforeach
</div>