<div class="Order-block Order-block_OPEN" id="step1">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{ __('orderPage.steps.delivery') }}</h2>
    </header>
    <x-wrappers.form>
        <x-form-elements.element-toggle
            name="delivery"
            :items="$deliveries"
        />
        <x-form-elements.element-input
            label="{{ __('orderPage.formElements.delivery.city.label') }}"
            name="name"
            placeholder="{{ __('orderPage.formElements.delivery.city.placeholder') }}"
        />
        <x-form-elements.element-textarea
            label="{{ __('orderPage.formElements.delivery.address.label') }}"
            name="name"
        />
        <div class="Order-footer">
            <a class="btn btn_success" href="/order/payment">
                {{ __('orderPage.buttons.next') }}
            </a>
        </div>
    </x-wrappers.form>
</div>