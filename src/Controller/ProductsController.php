<?php

namespace App\Controller;

use App\Services\Api\ForApiAutoCrm;
use App\Services\Response;
use App\Services\View;
use RetailCrm\Api\Exception\Api\AccountDoesNotExistException;
use RetailCrm\Api\Exception\Api\ApiErrorException;
use RetailCrm\Api\Exception\Api\MissingCredentialsException;
use RetailCrm\Api\Exception\Api\MissingParameterException;
use RetailCrm\Api\Exception\Api\ValidationException;
use RetailCrm\Api\Exception\Client\HandlerException;
use RetailCrm\Api\Exception\Client\HttpClientException;
use RetailCrm\Api\Interfaces\ApiExceptionInterface;
use RetailCrm\Api\Interfaces\ClientExceptionInterface;

class ProductsController
{

    /**
     * @throws ApiErrorException
     * @throws ClientExceptionInterface
     * @throws HandlerException
     * @throws AccountDoesNotExistException
     * @throws MissingCredentialsException
     * @throws ApiExceptionInterface
     * @throws HttpClientException
     * @throws MissingParameterException
     * @throws ValidationException
     */
    public function showAllProductsView(): void
    {
        $products = (new ForApiAutoCrm())->getAllProducts();

        $html = new View(ProductList, ['products' => $products]);
        $templateWithContent = new View(Template, ['content' => $html]);
        (new Response((string)$templateWithContent))->echo();
    }

    public function showResultView()
    {
        $html = new View(Result);
        $templateWithContent = new View(Template, ['content' => $html]);
        (new Response((string)$templateWithContent))->echo();
    }
}