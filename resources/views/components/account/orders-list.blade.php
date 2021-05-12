<div class="Orders">
    @forelse($orders as $order)
        <x-account.order-item :order="$order" />
    @empty
        {{ __('general.orders_empty') }}
    @endforelse
</div>
