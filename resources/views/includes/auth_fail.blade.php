@if ($message = Session::get('auth_fail'))
    <div class="form-error">{{ $message }}</div>
@endif
