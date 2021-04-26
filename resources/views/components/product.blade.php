<div class="Product">
    <div class="ProductCard">
        <div class="ProductCard-look">
            <div class="ProductCard-photo">
                @if($discount)
                    <div class="ProductCard-sale">
                        {{ $discount }}%
                    </div>
                @endif
                <img src="{{ $product->images->first()?->getUrl() }}" alt=""/>
            </div>
            <div class="ProductCard-picts">
                @foreach($product->images as $key => $image)
                    <a class="ProductCard-pict ProductCard-pict{{ !$key ? '_ACTIVE' : '' }}" href="{{ $image->getUrl() }}">
                        <img src="{{ $image->getUrl() }}" alt=""/>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="ProductCard-desc">
            <div class="ProductCard-header">
                <h2 class="ProductCard-title">{{ $product->title }}</h2>
                <div class="ProductCard-info">
                    <div class="ProductCard-cost">
                        <div class="ProductCard-price">@price($price)</div>
                        <div class="ProductCard-priceOld">@price($priceOld)</div>
                    </div>
                    <div class="ProductCard-compare">
                        <x-wrappers.form
                            action="{{ $compareUrl }}"
                            method="post"
                        >
                            <x-slot name="submit">
                                <x-buttons.compare />
                            </x-slot>
                        </x-wrappers.form>
                    </div>
                </div>
            </div>
            <div class="ProductCard-text">
                {{ $product->description }}
            </div>
            <x-wrappers.form
                action="{{ $addToCartUrl }}"
                method="post"
            >
                <div class="ProductCard-cart">
                    <div class="ProductCard-cartElement ProductCard-cartElement_amount">
                        <x-amount />
                    </div>
                    <div class="ProductCard-cartElement">
                        <x-buttons.cart />
                    </div>
                </div>
            </x-wrappers.form>
        </div>
    </div>

    <x-wrappers.tabs
        :links="[
            ['id' => '#description', 'title' => __('components.product.tabs.description')],
            ['id' => '#sellers', 'title' => __('components.product.tabs.sellers')],
            ['id' => '#addit', 'title' => __('components.product.tabs.addit')],
            ['id' => '#reviews', 'title' => __('components.product.tabs.reviews')],
        ]"
        :active="old('review') ? '#reviews' : '#description'"
    >
        <div class="Tabs-block" id="description">
            {{ $product->description }}
        </div>
        <div class="Tabs-block" id="sellers">
            <div class="Categories Categories_product">
                @foreach($sellers as $seller)
                <div class="Categories-row">
                    <div class="Categories-block Categories-block_info">
                        <div class="Categories-info">
                            <strong>
                                {{ $seller->title }}
                            </strong>
                        </div>
                    </div>
                    <div class="Categories-splitProps">
                    </div>
                    <div class="Categories-block Categories-price">
                        <strong>
                            @price($seller->pivot->price)
                        </strong>
                    </div>
                    <div class="Categories-block Categories-button">
                        <x-wrappers.form
                            action="{{ $seller->addToCartUrl }}"
                            method="post"
                            name="form_seller_{{ $seller->slug }}"
                        >
                            <x-slot name="submit">
                                <x-buttons.cart />
                            </x-slot>
                        </x-wrappers.form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="Tabs-block" id="addit">
            <div class="Product-props">
                @foreach($product->specifications as $specification)
                <div class="Product-prop">
                    <strong>
                        {{ $specification->title }}
                    </strong>
                    <span>{{ $specification->pivot->value }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="Tabs-block" id="reviews">
            <x-product.product-reviews :product="$product" />
        </div>
    </x-wrappers.tabs>
</div>
