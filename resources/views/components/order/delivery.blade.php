<div class="Order-block Order-block_OPEN" id="step1">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{ __('orderPage.steps.delivery') }}</h2>
    </header>
    <x-form-elements.element-toggle
        name="delivery"
        :items="$deliveries"
        required
    />
    <x-form-elements.element-input
        label="{{ __('orderPage.formElements.delivery.city.label') }}"
        name="city"
        required
        value="{{ $order?->city }}"
        placeholder="{{ __('orderPage.formElements.delivery.city.placeholder') }}"
    />
    <x-form-elements.element-textarea
        label="{{ __('orderPage.formElements.delivery.address.label') }}"
        required
        name="address"
        value="{{ $order?->address }}"
    />
    <div class="Order-footer">
        <x-buttons.next />
    </div>
</div>