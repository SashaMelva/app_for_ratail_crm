<section class="container">
    <h1>Создайте заказ</h1>
    <div class="order-content">
        <div>
            <h2>Данные о товаре</h2>
            <?= $this->arguments['product']->name ?>
            <div>
                <img class="img-template" src="<?= $this->arguments['product']->imageUrl ?>" alt="фото - <?php  $product->name ?>">
            </div>
            <div>
                <p>Цена: <?= $this->arguments['product']->offers[0]->prices[0]->price ?> <?= $this->arguments['product']->offers[0]->prices[0]->currency ?></p>
                <p>Кол-во на складе: <?= $this->arguments['product']->quantity ?> <?= $this->arguments['product']->offers[0]->unit->sym ?></p></div>
        </div>
        <form method="post" action="/order/add" id="form-send"
              class="form-authorization send-window">
            <h3>Введите данные для Формирования заказа</h3>

            <label class="label-form" for="name">Имя</label>
            <input name="name" id="name" class="input-form" required>

            <label class="label-form" for="email">Email</label>
            <input type="email" name="email" id="email" class="input-form" placeholder="youremail@mail.com" required>

            <label class="label-form" for="phone">Телефон</label>
            <input name="phone" id="phone" class="input-form" placeholder="+7(000) 00-00-00" required>

            <input name="idProduct" id="idProduct" value="<?= $this->arguments['product']->id ?>" hidden="hidden">
            <button type="submit" class="btn btn-start">Создать заказ</button>
            <a href="/" class="btn btn-start btn-for-a">Назад</a>
        </form>

    </div>
</section>


