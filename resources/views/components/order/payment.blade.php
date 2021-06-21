<div class="Order-block Order-block_OPEN" id="step1">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{ __('orderPage.steps.payment') }}</h2>
    </header>
    <x-form-elements.element-toggle
        name="payment"
        :items="$payments"
    />
    <div class="Order-footer">
        <x-buttons.next />
    </div>
</div>