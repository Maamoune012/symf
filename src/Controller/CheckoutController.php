<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Form\CheckoutType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\Form\Form;
use Symfony\Entity\Form;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    public function index()
        return $this->render('checkout/index.html.twig', [
            //'controller_name' => 'CheckoutController',
   
        ]);

    }

    //return $this->redirectToRoute(route: 'cart');
}


