@if(session()->has('message'))
    <x-wrappers.column-mark icon="icons.contacts.mail">
        {{ session()->get('message') }}
    </x-wrappers.column-mark>
@endif