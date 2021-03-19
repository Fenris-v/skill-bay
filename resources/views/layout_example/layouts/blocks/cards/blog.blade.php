{{--Карточка блога/статьи и т.п.--}}
<div class="Card">
    <a class="Card-picture" href="#">
        <img src="{{ $item['img'] ?? '' }}" alt="{{ $item['alt'] ?? '' }}"/>
    </a>
    @isset($item['date_at'])
        <div class="Card-date">
            <strong class="Card-date-number">{{ $item['date_at'] }}</strong>
            <span class="Card-date-month">nov</span>
        </div>
    @endisset
    @isset($item['date_to'])
        <div class="Card-date Card-date_to">
            <strong class="Card-date-number">{{ $item['date_to'] }}</strong>
            <span class="Card-date-month">nov</span>
        </div>
    @endisset
    <div class="Card-pin"></div>
    <div class="Card-content">
        <strong class="Card-title">
            <a href="#">Basic Time Management Advanced Course</a>
        </strong>
        <div class="Card-description">Lorem ipsum dolor sit amet consectetuer adipiscing elit sed diam
            nonummy nibh euismod tincid unt ut laoreet dolore
        </div>
    </div>
</div>
