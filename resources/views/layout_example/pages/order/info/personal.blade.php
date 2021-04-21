{{--Заполнение личных данных--}}
<div class="row">
    <div class="row-block">
        <div class="form-group">
            <label class="form-label" for="name">ФИО</label>
            <input class="form-input" id="name" name="name" type="text"
                   value="Иванов Иван Иванович"/>
        </div>
        <div class="form-group">
            <label class="form-label" for="phone">Телефон
            </label>
            <input class="form-input" id="phone" name="phone" type="text" value="+70000000000"/>
        </div>
        <div class="form-group">
            <label class="form-label" for="mail">E-mail
            </label>
            <input class="form-input" id="mail" name="mail" type="text" value=""
                   data-validate="require"/>
        </div>
    </div>
    <div class="row-block">
        <div class="form-group">
            <label class="form-label" for="password">Пароль
            </label>
            <input class="form-input" id="password" name="password" type="password"
                   placeholder="Тут можно изменить пароль"/>
        </div>
        <div class="form-group">
            <label class="form-label" for="passwordReply">Подтверждение пароля
            </label>
            <input class="form-input" id="passwordReply" name="passwordReply" type="password"
                   placeholder="Введите пароль повторно"/>
        </div>
        <div class="form-group"><a class="btn btn_muted Order-btnReg" href="#">Я уже
                зарегистрирован</a>
        </div>
    </div>
</div>
