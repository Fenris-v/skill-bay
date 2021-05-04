<div class="Section-columnSection">
    <header class="Section-header">
        <strong class="Section-title">
            {{ __('orderPage.progress') }}
        </strong>
    </header>
    <div class="Section-columnContent">
        <ul class="menu menu_vt Order-navigate">
            @foreach($steps as $step)
                <li {{ $attributes->class(['menu-item', 'menu-item_ACTIVE' => !$step['isCompleted']]) }}>
                    <a class="menu-link" href="{{ $step['url'] }}">{{ $step['title'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>