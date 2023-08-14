<?php

require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";


use Dotenv\Dotenv;


try {
    $dotenv = Dotenv::createImmutable(dirname(__DIR__, 1));
    $dotenv->load();
} catch (Exception $e) {
    printf("Ошибка при подключении окружения: %s в файле %s(%d)", $e->getMessage(), $e->getFile(), $e->getLine());
    exit(1);
}

define('DOMAIN_NAME', $_ENV['DOMAIN_NAME']);
define('API_KEY', $_ENV['API_KEY']);

define('PROJECT_DIR', dirname(__DIR__, 1));

const Template = PROJECT_DIR . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "template.php";
const OrderProduct = PROJECT_DIR . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "order_product.php";
const FormCreateOrder = PROJECT_DIR . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "component" . DIRECTORY_SEPARATOR . "form_send.php";
const Result = PROJECT_DIR . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "component" . DIRECTORY_SEPARATOR . "result.php";
const ProductList = PROJECT_DIR . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "products_list.php";
const NotFound = PROJECT_DIR . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "component" . DIRECTORY_SEPARATOR . "not_found.php";