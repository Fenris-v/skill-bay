<div class="Order-block Order-block_OPEN" id="step1">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{ __('orderPage.steps.personal') }}</h2>
    </header>
    <x-wrappers.form>
        <div class="row">
            <div class="row-block">
                <x-form-elements.element-input
                    label="{{ __('orderPage.formElements.personal.fullName.label') }}"
                    name="name"
                    placeholder="{{ __('orderPage.formElements.personal.fullName.placeholder') }}"
                />
                <x-form-elements.element-input
                    label="{{ __('orderPage.formElements.personal.phone.label') }}"
                    name="phone"
                    placeholder="{{ __('orderPage.formElements.personal.phone.placeholder') }}"
                />
                <x-form-elements.element-input
                    label="{{ __('orderPage.formElements.personal.email.label') }}"
                    name="mail"
                    placeholder="{{ __('orderPage.formElements.personal.email.placeholder') }}"
                />
            </div>
            <div class="row-block">
                <x-form-elements.element-input
                    label="{{ __('orderPage.formElements.personal.password.label') }}"
                    name="password"
                    placeholder="{{ __('orderPage.formElements.personal.password.placeholder') }}"
                />
                <x-form-elements.element-input
                    label="{{ __('orderPage.formElements.personal.confirmPassword.label') }}"
                    name="passwordReply"
                    placeholder="{{ __('orderPage.formElements.personal.confirmPassword.placeholder') }}"
                />
                <div class="form-group">
                    <a class="btn btn_muted Order-btnReg" href="#">
                        {{ __('orderPage.buttons.login') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="Order-footer">
            <a class="btn btn_success" href="/order/delivery">
                {{ __('orderPage.buttons.next') }}
            </a>
        </div>
    </x-wrappers.form>
</div>