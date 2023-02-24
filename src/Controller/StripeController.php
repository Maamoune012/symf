<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    #[Route('/commande/create-session', name: 'stripe_create_session')]
    public function index(Product $cart)
    {
        #return $this->render('stripe/index.html.twig', [
        #'controller_name' => 'StripeController',
        #]);

        $products_for_stripe = [];
        $YOUR_DOMAIN = 'http://127.0.0.1:8000/';

        foreach($cart as $product){

            $products_for_stripe[] = [
                'price_data' => [
                    'currency' => 'xof',
                    'price' => $product['product']->getPrice(),
                    'product_data' => [
                        'name' => $product['product']->getName(),
                        'images' => [$YOUR_DOMAIN."/upload/".$product['product']->getPhotos],
                    ],
                ],
                'quantity' => $product['quantity'],
            ];
        }


        \Stripe\Stripe::setApiKey('sk_test_51McVkAFVqpwutoMidXKkTjr8ZKBTzzKD3s27Cpn5GNeXEXG3yVkZuSiSF6198dAC6G05FcIA4BpcMqZHRAYjxGNa00rqLNYSQw');

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                $products_for_stripe,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);

        $response = new JsonResponse(['id' => $checkout_session->id]);
        return $response;

    }
}
