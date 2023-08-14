<div class="container">
    <h1>Список товаров</h1>
    <section class="content-product">
        <?php foreach ($this->arguments['products'] as $product): ?>
        <div>
        <?= $product->name ?>
        <div>
            <img class="img-template" src="<?= $product->imageUrl ?>" alt="фото - <?= $product->name ?>">
        </div>
        <div>
            <p>Цена:<?= $product->offers[0]->prices[0]->price ?><?= $product->offers[0]->prices[0]->currency ?></p>
            <p>Кол-во на складе:<?= $product->quantity ?> <?= $product->offers[0]->unit->sym ?></p>
        </div>
        <a class="btn btn-start btn-for-a" href="/order/create?action=order_create&id=<?= $product->id ?>">Заказать</a>
        </div>
       <?php endforeach; ?>
    </section>
</div>