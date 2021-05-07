<div class="Order-block Order-block_OPEN" id="step1">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{ __('orderPage.steps.personal') }}</h2>
    </header>
    <div class="row">
        <div class="row-block">
            <x-form-elements.element-input
                label="{{ __('orderPage.formElements.personal.fullName.label') }}"
                name="name"
                required
                placeholder="{{ __('orderPage.formElements.personal.fullName.placeholder') }}"
            />
            <x-form-elements.element-input
                label="{{ __('orderPage.formElements.personal.phone.label') }}"
                name="phone"
                required
                placeholder="{{ __('orderPage.formElements.personal.phone.placeholder') }}"
            />
            <x-form-elements.element-input
                label="{{ __('orderPage.formElements.personal.email.label') }}"
                name="email"
                required
                placeholder="{{ __('orderPage.formElements.personal.email.placeholder') }}"
            />
        </div>
        @guest()
            <div class="row-block">
                <x-form-elements.element-input
                    label="{{ __('orderPage.formElements.personal.password.label') }}"
                    name="password"
                    required
                    type="password"
                    placeholder="{{ __('orderPage.formElements.personal.password.placeholder') }}"
                />
                <x-form-elements.element-input
                    label="{{ __('orderPage.formElements.personal.confirmPassword.label') }}"
                    name="password_confirmation"
                    required
                    type="password"
                    placeholder="{{ __('orderPage.formElements.personal.confirmPassword.placeholder') }}"
                />
                <div class="form-group">
                    <a class="btn btn_muted Order-btnReg" href="/login">
                        {{ __('orderPage.buttons.login') }}
                    </a>
                </div>
            </div>
        @endguest
    </div>
    <div class="Order-footer">
        <x-buttons.next />
    </div>
</div>