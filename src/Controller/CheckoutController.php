<?php

namespace App\Controller;
use App\Entity\Delivery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class CheckoutController extends AbstractController
{

    #[Route('/checkout', name: 'app_checkout')]
    public function index()
    {
        return $this->render('checkout/index.html.twig', [
            'controller_name' => 'CheckoutController',
        ]);
        
        //Enregistrer mes produits OrderDetails()    
   
}
}

