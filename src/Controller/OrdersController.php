<?php

namespace App\Controller;

use App\Services\Api\ForApiAutoCrm;
use App\Services\Response;
use App\Services\View;

class OrdersController
{
    public function showOrderCreateFormView(int $idProduct): void
    {
        $product = (new ForApiAutoCrm())->getProductsById($idProduct);
       
        $html = new View(OrderProduct, ['product' => $product]);
        $templateWithContent = new View(Template, ['content' => $html]);
        (new Response((string)$templateWithContent))->echo();
    }

    public function addOrder(string $name, string $email, string $phone, int $idProduct): void
    {
        $validated = $this->validateFormAddOrder($name, $email, $phone);
        (new ForApiAutoCrm())->creteOrder($validated, $idProduct);

        header("Location: /result");
    }

    private function validateFormAddOrder(string $name, string $email, string $phone)
    {
        return [
            'name' => $name, 
            'email' => $email, 
            'phone' => $phone
        ];
    }

}