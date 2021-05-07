<div class="Order-block Order-block_OPEN" id="step1">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{ __('orderPage.steps.delivery') }}</h2>
    </header>
    <x-wrappers.form>
        <x-form-elements.element-toggle
            name="pay"
            :items="$payments"
        />
        <div class="Order-footer">
            <a class="btn btn_success" href="/order/accept">
                {{ __('orderPage.buttons.next') }}
            </a>
        </div>
    </x-wrappers.form>
</div>