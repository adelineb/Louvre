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
                //"email" => "ajacquelin27@hotmail.com",
            ));
            return \Stripe\Token::retrieve($token)->email;
        } catch(\Stripe\Error\Card $e) {
            $request->getSession()->getFlashBag()->add('refus', 'Votre paiement a échoué. Veuillez ressaisir votre paiement. Merci.');
            return false;
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