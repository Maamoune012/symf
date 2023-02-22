<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    #[Route('/stripe/create-session', name: 'app_stripe_create_session')]
    public function index()
    {
        #return $this->render('stripe/index.html.twig', [
        #'controller_name' => 'StripeController',
        #]);

        $products_for_stripe = [];
        $YOUR_DOMAIN = 'http://127.0.0.1:8000/';


        \Stripe\Stripe::setApiKey('sk_test_51McVkAFVqpwutoMidXKkTjr8ZKBTzzKD3s27Cpn5GNeXEXG3yVkZuSiSF6198dAC6G05FcIA4BpcMqZHRAYjxGNa00rqLNYSQw');

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                $products_for_stripe,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);

    }
}
