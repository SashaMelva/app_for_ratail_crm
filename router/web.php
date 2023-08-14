<?php

use App\Controller\OrdersController;
use App\Controller\ProductsController;
use App\Services\Api\ForApiAutoCrm;
use App\Services\Response;
use App\Services\View;

session_start();

if (isset($_SERVER['REQUEST_URI'])) {
    try {
    switch ($_SERVER['REQUEST_URI']) {
        case '/' :
            (new ProductsController())->showAllProductsView();
            break;
        case '/order/add' :
            (new OrdersController())->addOrder($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['idProduct']);
            break;
        case '/result' :
            (new ProductsController())->showResultView();
            break;
    };
    if (isset($_GET['action'])) {
        match ($_GET['action']) {
            'order_create' => (new OrdersController())->showOrderCreateFormView($_GET['id']),
        };
    } else {
        throw new Exception('Unexpected match value');
    }

    } catch (Exception $e) {
        $html = new View(NotFound);
        $templateWithContent = new View(Template, ['content' => $html]);
        (new Response((string)$templateWithContent))->echo();
    }
}

exit();