@if(session()->has('message'))
    <div class="wrap">
        <div class="Middle-header">
            <div style="margin-top: 5px; margin-left: auto">
                <x-wrappers.column-mark icon="icons.contacts.mail">
                    {{ session()->get('message') }}
                </x-wrappers.column-mark>
            </div>
        </div>
    </div>
@endif