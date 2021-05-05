@if(session()->has('message'))
    <div class="wrap">
        <div {{ $attributes->class(['custom-alert', 'custom-alert-' . session()->get('alertType', 'success')]) }}>
            <span class="closebtn">&times;</span>
            {{ session()->get('message') }}
        </div>
    </div>
@endif