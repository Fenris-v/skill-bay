@if ($hotCategories->isNotEmpty())
    <div class="Section">
        <div class="wrap">
            <div class="BannersHome">
                @foreach($hotCategories as $category)
                    <x-categories.hot-item :category="$category" />
                @endforeach
            </div>
        </div>
    </div>
@endif
