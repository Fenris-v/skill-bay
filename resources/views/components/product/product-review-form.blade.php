<form class="form" method="POST">
    @csrf

    <div class="form-group">
        <textarea class="form-textarea @error('comment') form-textarea_error @enderror" name="comment" id="comment" placeholder="Ваш комментарий..."></textarea>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="row-block">
                <input class="form-input @error('name') form-input_error @enderror" id="name" name="name" type="text" placeholder="Ваше Имя"/>
            </div>
            <div class="row-block">
                <input class="form-input @error('email') form-input_error @enderror" id="email" name="email" type="email" placeholder="Ваш Email"/>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn_muted" type="submit">Оставить отзыв</button>
    </div>
</form>
