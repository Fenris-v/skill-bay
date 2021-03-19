{{--Список подписок--}}
<div class="Section-columnSection">
    @include('layouts.blocks.header_line', ['title' => 'Follow Us'])

    <div class="Section-columnContent">
        <div class="Footer-payments Footer-payments_column">
            @each('layouts.blocks.socials.follow_item', $follows, 'follow')
        </div>
    </div>
</div>
