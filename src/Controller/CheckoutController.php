<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\Type\CheckoutType;
use Doctrine\Persistance\ManagerRegistry;

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout')]
    public function index(ManagerRegistry $doctrine, Request $request) //:Response
    {
        $em= $doctrine->getManager();
        $delivery= $em->getRepository(Delivery::class)->findALl();
        return $this->render('checkout/index.html.twig', /* [
            'controller_name' => 'CheckoutController',
        ] */);
    }
    
    public function checkout(ManagerRegistry $doctrine, Request $request)
    {
        $delivery = new Delivery();
        $delivery->setName($parameter['name']);
        $delivery->setLastname($parameter['lastname']);
        $delivery->setZipcode($parameter['zipcode']);
        $delivery->setCity($parameter['city']);
        $delivery->setPrice($parameter['price']);
        $delivery->setState($parameter['state']);
        $delivery->setEmail($parameter['email']);
        $delivery->setAdress2($parameter['adress2']);
        $delivery->setTel($parameter['tel']);
        $delivery->setCountry($parameter['country']);
        $delivery->setDelivered_at($parameter['delivered_at']);
        
        $from= $this.createForm(CheckoutType::class, $delivery);
        $from->handleRequest($request);

        return $this->renderForm('checkout/index.html.twig', [
            'form'-> $form
        ]);
    }
}
