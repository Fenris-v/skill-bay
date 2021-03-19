{{--Доставка--}}
<div class="form-group">
    <div>
        <label class="toggle">
            <input type="radio" name="delivery" value="ordinary" checked="checked"/><span
                class="toggle-box"></span><span class="toggle-text">Обычная доставка</span>
        </label>
    </div>
    <div>
        <label class="toggle">
            <input type="radio" name="delivery" value="express"/>
            <span class="toggle-box"></span>
            <span class="toggle-text">Экспресс доставка</span>
        </label>
    </div>
</div>
<div class="form-group">
    <label class="form-label" for="city">Город
    </label>
    <input class="form-input" id="city" name="city" type="text"/>
</div>
<div class="form-group">
    <label class="form-label" for="address">Адрес
    </label>
    <textarea class="form-textarea" name="address" id="address"></textarea>
</div>
