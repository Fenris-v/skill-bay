{{--Верхняя панель в хэдере--}}
<div class="ControlPanel">
    <div class="wrap">
        <div class="row ControlPanel-row">
            <div class="row-block">
                <div class="row ControlPanel-rowSplit">
                    <div class="row-block">
                        <a class="ControlPanel-title" href="sale.html">Скидки</a>
                    </div>
                    <x-socials position="header" />
                </div>
            </div>

            <nav class="row-block">
                @include('layouts.header.auth')
            </nav>
        </div>
    </div>
</div>
