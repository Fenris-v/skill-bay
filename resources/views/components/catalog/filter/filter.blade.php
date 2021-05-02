<div class="Section-column">
    <div class="Section-columnSection">
        <header class="Section-header">
            <strong class="Section-title">{{ __('catalog.filter') }}</strong>
        </header>
        <div class="Section-columnContent">
            <form class="form" action="{{ url()->current() }}" method="get">
                <div class="form-group">
                    <div class="range Section-columnRange">
                        <input class="range-line" id="price" name="filter[price]" type="text" data-type="double"
                               data-min="{{ $minMaxPrice['min_price'] }}" data-max="{{ $minMaxPrice['max_price'] }}"
                               data-from="{{ $filterPrice[0] ?? $minMaxPrice['min_price'] }}"
                               data-to="{{ $filterPrice[1] ?? $minMaxPrice['max_price'] }}"/>
                        <div class="range-price">{{ __('catalog.price') }}:&#32;
                            <div class="rangePrice"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input class="form-input form-input_full" id="title" name="filter[title]"
                           type="text" value="{{ request()->get('title') }}"
                           placeholder="{{ __('catalog.search') }}"/>
                </div>
                <div class="form-group">
                    <label>{{ __('catalog.seller') }}
                        <select class="form-select" name="filter[seller]">
                            <option value="">{{ __('catalog.not-selected') }}</option>
                            @foreach($sellers as $seller)
                                <option {{ isset(request()->get('filter')['seller']) &&
                                     request()->get('filter')['seller'] === $seller->title ? 'selected' : '' }}
                                        value="{{ $seller->title }}">{{ $seller->title }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                @foreach($specifications as $specification)
                    @switch($specification->type)
                        @case(\App\Models\Specification::CHECKBOX)
                        <x-catalog.filter.checkbox :specification="$specification"/>
                        @break
                        @case(\App\Models\Specification::SELECT )
                        <x-catalog.filter.select :specification="$specification"
                                                 :specifications-values="$specificationsValues"/>
                        @break
                        @case(\App\Models\Specification::MULTIPLE)
                        <x-catalog.filter.select :specification="$specification"
                                                 :specifications-values="$specificationsValues"
                                                 :multiple="true"/>
                    @endswitch
                @endforeach

                <div class="form-group">
                    <div class="buttons">
                        <input type="submit" class="btn btn_square btn_primary btn_narrow"
                               value="{{ __('catalog.accept') }}">

                        <a href="{{ url()->current() }}"
                           class="btn btn_square btn_dark btn_narrow">
                            {{ __('catalog.reset') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
