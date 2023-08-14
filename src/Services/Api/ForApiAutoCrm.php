<?php

namespace App\Services\Api;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMMissedTokenException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use AmoCRM\Models\LeadModel;
use RetailCrm\Api\Client;
use RetailCrm\Api\Exception\Api\AccountDoesNotExistException;
use RetailCrm\Api\Exception\Api\ApiErrorException;
use RetailCrm\Api\Exception\Api\MissingCredentialsException;
use RetailCrm\Api\Exception\Api\MissingParameterException;
use RetailCrm\Api\Exception\Api\ValidationException;
use RetailCrm\Api\Exception\Client\BuilderException;
use RetailCrm\Api\Exception\Client\HandlerException;
use RetailCrm\Api\Exception\Client\HttpClientException;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Interfaces\ApiExceptionInterface;
use RetailCrm\Api\Interfaces\ClientExceptionInterface;

use RetailCrm\Api\Enum\CountryCodeIso3166;
use RetailCrm\Api\Enum\Customers\CustomerType;
use RetailCrm\Api\Model\Entity\Orders\Delivery\OrderDeliveryAddress;
use RetailCrm\Api\Model\Entity\Orders\Delivery\SerializedOrderDelivery;
use RetailCrm\Api\Model\Entity\Orders\Items\Offer;
use RetailCrm\Api\Model\Entity\Orders\Items\OrderProduct;
use RetailCrm\Api\Model\Entity\Orders\Items\PriceType;
use RetailCrm\Api\Model\Entity\Orders\Items\Unit;
use RetailCrm\Api\Model\Entity\Orders\Order;
use RetailCrm\Api\Model\Entity\Orders\Payment;
use RetailCrm\Api\Model\Entity\Orders\SerializedRelationCustomer;
use RetailCrm\Api\Model\Request\Orders\OrdersCreateRequest;

use \Datetime;
use \DateInterval;


class ForApiAutoCrm
{
    private Client $client;

    /**
     * @throws BuilderException
     */
    public function __construct()
    {
        $this->client = SimpleClientFactory::createClient(
            'https://' . DOMAIN_NAME . '.retailcrm.ru',
            API_KEY
        );
    }

    /**
     * @throws ApiErrorException
     * @throws ClientExceptionInterface
     * @throws HandlerException
     * @throws MissingCredentialsException
     * @throws AccountDoesNotExistException
     * @throws ApiExceptionInterface
     * @throws HttpClientException
     * @throws MissingParameterException
     * @throws ValidationException
     */
    public function getAllProducts(): array
    {
        return $this->client->store->products()->products;
    }

    public function getProductsById(int $idProduct)
    {
        $products = $this->client->store->products()->products;
        foreach($products as $product) {
            if($product->id == $idProduct) {
                return $product;
            }
        }

        return 'exeption';
    }

    public function creteOrder(array $data, $idProduct)
    {
        $product = $this->getProductsById($idProduct);
        
        $request         = new OrdersCreateRequest();
        $order           = new Order();
        $payment         = new Payment();
        $delivery        = new SerializedOrderDelivery();
        $deliveryAddress = new OrderDeliveryAddress();
        $offer           = new Offer();
        $item            = new OrderProduct();
        
        $payment->type   = 'bank-card';
        $payment->status = 'paid';
        $payment->amount = 1000;
        $payment->paidAt = new DateTime();
        
        $deliveryAddress->index      = '344001';
        $deliveryAddress->countryIso = CountryCodeIso3166::RUSSIAN_FEDERATION;
        $deliveryAddress->region     = 'Region';
        $deliveryAddress->city       = 'City';
        $deliveryAddress->street     = 'Street';
        $deliveryAddress->building   = '10';
        
        $delivery->address = $deliveryAddress;
        $delivery->cost    = 0;
        $delivery->netCost = 0;
        
        $offer->name        = 'Offer №1445123';
        $offer->displayName = 'Offer №1445123';
        $offer->xmlId       = 'tGunLo27jlPGmbA8BrHxY2';
        $offer->article     = '14451445-14451445';
        $offer->unit        = new Unit('796', 'Piece', 'pcs');
        
        $item->offer         = $offer;
        $item->quantity      = 1;
        $item->id = $product->id;
        $item->productName = $product->name;
        $item->initialPrice = $product->price;
        
        $order->delivery      = $delivery;
        $order->items         = [$item];
        $order->payments      = [$payment];
        $order->orderMethod   = 'phone';
        $order->countryIso    = CountryCodeIso3166::RUSSIAN_FEDERATION;
        $order->firstName     = $data['name'];;
        $order->lastName      = '';
        $order->patronymic    = '';
        $order->phone         = $data['phone'];;
        $order->email         = $data['email'];;
   
        $order->shipmentDate  = (new DateTime())->add(new DateInterval('P7D'));
        $order->shipped       = false;
        $order->customFields  = [
            "galka" => false,
            "test_number" => 0,
            "otpravit_dozakaz" => false,
        ];
        
        $request->order = $order;
        $request->site  = 'shop_test';
        
        try {
            $response = $this->client->orders->create($request);
        } catch (ApiExceptionInterface | ClientExceptionInterface $exception) {
            echo $exception; 
            exit(-1);
        }
    }
}