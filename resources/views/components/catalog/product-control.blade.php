<div class="Card-hover">
    <a class="Card-btn" href="#">
        <x-icons.catalog.bookmark />
    </a>
    <a class="Card-btn" href="#">
        <x-icons.catalog.to-cart />
    </a>
    <x-wrappers.icon-form
        icon='icons.catalog.to-compare'
        method='post'
        route='products.addToCompare'
        :product='$product'
        :formId='uniqid()'
    />
</div>
