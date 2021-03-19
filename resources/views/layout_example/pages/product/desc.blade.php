{{--Описание товара--}}
<div class="ProductCard-desc">
    <div class="ProductCard-header">
        <h2 class="ProductCard-title">Barand New Phone Smart Busines</h2>
        <div class="ProductCard-info">
            <div class="ProductCard-cost">
                <div class="ProductCard-price">$@price('55.00')</div>
                <div class="ProductCard-priceOld">$@price('115.00')</div>
            </div>

            <div class="ProductCard-compare">
                <a class="btn btn_default" href="#">
                    <img class="btn-icon" src="/assets/img/icons/card/change.svg" alt="change.svg"/>
                </a>
            </div>
        </div>
    </div>
    <div class="ProductCard-text">
        <ul>
            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod</li>
            <li>tempor incididunt ut labore et dolore magna aliqua. Lorem</li>
            <li>ipsum dolor sit ameabore et dolore magna aliqua. Lorem ipsum</li>
        </ul>
    </div>
    <div class="ProductCard-cart">
        <div class="ProductCard-cartElement ProductCard-cartElement_amount">
            @include('layouts.blocks.amount', ['class' => 'Amount Amount_product'])
        </div>
        <div class="ProductCard-cartElement">
            <a class="btn btn_primary" href="#">
                <img class="btn-icon" src="/assets/img/icons/card/cart_white.svg"
                    alt="cart_white.svg"/>
                <span class="btn-content">Add To Cart</span>
            </a>
        </div>
    </div>
    <div class="ProductCard-footer">
        <div class="ProductCard-tags">
            <strong class="ProductCard-tagsTitle">Tags:</strong>
            <a href="#">Accesories</a>,
            <a href="#">Creative</a>,
            <a href="#">Design</a>,
            <a href="#">Gaming</a>
        </div>
    </div>
</div>
