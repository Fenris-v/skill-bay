<div class="Product">
    <div class="ProductCard">
        <div class="ProductCard-look">
            <div class="ProductCard-photo">
                @if($discount)
                    <div class="ProductCard-sale">
                        {{ $discount }}%
                    </div>
                @endif
                <img src="{{ $product->images->first()?->url() }}" alt=""/>
            </div>
            <div class="ProductCard-picts">
                @foreach($product->images as $key => $image)
                    <a class="ProductCard-pict ProductCard-pict{{ !$key ? '_ACTIVE' : '' }}" href="{{ $image->url() }}">
                        <img src="{{ $image->url() }}" alt=""/>
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
        <!--Для дальнейшей правки-->
        <div class="Tabs-block" id="reviews">
            <div class="Comments">
                <div class="Comment">
                    <div class="Comment-column Comment-column_pict">
                        <div class="Comment-avatar">
                        </div>
                    </div>
                    <div class="Comment-column">
                        <header class="Comment-header">
                            <div>
                                <strong class="Comment-title">Alexandra Brownie
                                </strong><span class="Comment-date">22:50 - 25 Декабря 2020</span>
                            </div>
                        </header>
                        <div class="Comment-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis natoque penatibus et magnis dis parturient montesti, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eutu, pretiumem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justotuio, rhoncus ut loret, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus element semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae.
                        </div>
                    </div>
                </div>
            </div>
            <header class="Section-header Section-header_product">
                <h3 class="Section-title">Оставить отзыв</h3>
            </header>
            <div class="Tabs-addComment">
                <form class="form" action="#" method="post">
                    <div class="form-group">
                        <textarea class="form-textarea" name="review" id="review" placeholder="Ваш комментарий..."></textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="row-block">
                                <input class="form-input" id="name" name="name" type="text" placeholder="Ваше Имя"/>
                            </div>
                            <div class="row-block">
                                <input class="form-input" id="email" name="email" type="text" placeholder="Ваш Email"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn_muted" type="submit">Оставить отзыв</button>
                    </div>
                </form>
            </div>
        </div>
    </x-wrappers.tabs>
</div>
