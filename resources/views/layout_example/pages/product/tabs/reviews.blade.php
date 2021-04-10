{{--Обзоры--}}
@php
$reviews = [
    [
        'name' => 'Alexandra Brownie',
        'date' => 'December 25&#32;&#32;/&#32;&#32;2017&#32;&#32;/&#32;&#32;22:50',
        'text' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing
                    elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis
                    natoque penatibus et magnis dis parturient montesti, nascetur ridiculus mus.
                    Donec quam felis, ultricies nec, pellentesque eutu, pretiumem. Nulla
                    consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec,
                    vulputate eget, arcu. In enim justotuio, rhoncus ut loret, imperdiet a,
                    venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer
                    tincidunt. Cras dapibus. Vivamus element semper nisi. Aenean vulputate
                    eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae.',
    ]
];
@endphp
<div class="Tabs-block" id="reviews">
    <header class="Section-header">
        <h3 class="Section-title">2 Reviews</h3>
    </header>
    <div class="Comments">
        @each('pages.product.tabs.review', $reviews, 'review')
    </div>
    <header class="Section-header Section-header_product">
        <h3 class="Section-title">Add Review
        </h3>
    </header>
    <div class="Tabs-addComment">
        @include('pages.product.tabs.review_form')
    </div>
</div>
