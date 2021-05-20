<div class="Card-hover">
    <x-wrappers.icon-link
        icon='icons.catalog.bookmark'
        href="{{route('products.show', $product)}}"
    />
    <x-wrappers.icon-form
        icon='icons.catalog.to-cart'
        method='post'
        route='products.addToCart'
        :product='$product'
        :formId='uniqid()'
    >
        <input type="hidden" name="amount" value="1" />
    </x-wrappers.icon-form>
    <x-wrappers.icon-form
        icon='icons.catalog.to-compare'
        method='post'
        route='products.addToCompare'
        :product='$product'
        :formId='uniqid()'
    />
</div>
