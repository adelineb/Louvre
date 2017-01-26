<?php

namespace Louvre\BilletterieBundle\Stripe;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Stripe\Stripe;
use stripe\Charge;
use Stripe\Error\Card;


class StripeService extends Controller
{
    /**
     * @var string
     */
    private $apiKey;
    /**
     * @var string
     */
    private $apiToken;
    public function __construct($apiKey, $apiToken)
    {
        $this->apiKey = $apiKey;
        $this->apiToken = $apiToken;
    }
    public function chargeCard($api, $token, $price){
        \Stripe\Stripe::setApiKey($api);
        try {
            \Stripe\Charge::create(array(
                "amount" =>  $price * 100,
                "currency" => "eur",
                "source" => $token,
                "description" => "Billet musée du Louvre",
            ));
        } catch(\Stripe\Error\Card $e) {
            // paiement refusé
        }
    }
    public function getApiKey()
    {
        return $this->apiKey;
    }
    public function getApiToken()
    {
        return $this->apiToken;
    }
}