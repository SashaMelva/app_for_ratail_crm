<form method="post" action="/lead/create" id="form-send" class="form-authorization container-modal-window send-window">
    <h3>Введите данные для отправки заявки</h3>

    <label class="label-form" for="name">Имя</label>
    <input name="name" id="name" class="input-form" required>

    <label class="label-form" for="email">Email</label>
    <input type="email" name="email" id="email" class="input-form" placeholder="youremail@mail.com" required>

    <label class="label-form" for="phone">Телефон</label>
    <input name="phone" id="phone" class="input-form" placeholder="+7(000) 00-00-00" required>

    <label class="label-form" for="price">Цена</label>
    <input name="price" id="price" class="input-form" required>

    <button type="submit" class="btn btn-start">Отправить</button>
</form>
