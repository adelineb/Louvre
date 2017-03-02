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


    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
    public function chargeCard($token, $price){
        \Stripe\Stripe::setApiKey($this->apiKey);
        if ($price > 0) {
            \Stripe\Charge::create(array(
                "amount" =>  $price * 100,
                "currency" => "eur",
                "source" => $token,
                "description" => "Billet musée du Louvre",
            ));
            return \Stripe\Token::retrieve($token)->email;
        }
    }
}
