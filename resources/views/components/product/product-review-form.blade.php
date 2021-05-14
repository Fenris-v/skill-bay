@foreach ($errors->all() as $error)
    <div class="form-error">{{ $error }}</div>
@endforeach

<form class="form" method="POST">
    @csrf

    <div class="form-group">
        <textarea class="form-textarea @error('comment') form-textarea_error @enderror" name="comment" id="comment" placeholder="@lang('productPage.review_form.comment')">
             {{ old('comment') }}
        </textarea>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="row-block">
                <input class="form-input @error('name') form-input_error @enderror" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="@lang('productPage.review_form.name')"/>
            </div>
            <div class="row-block">
                <input class="form-input @error('email') form-input_error @enderror" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="@lang('productPage.review_form.email')"/>
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="hidden" name="review" value="1" />
        <button class="btn btn_muted" type="submit">@lang('product.post_review')</button>
    </div>
</form>
