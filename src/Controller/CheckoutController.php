<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderDetails;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/checkout', name: 'app_checkout')]
    public function index($form, $cart): Response
    {
        //private $form;
        //$form->sendRequest($request);
        if($form->isSubmitted() && $form->isValid){
            $date = new DateTime();
            $carriers = $form->get('carriers')->getData();
            $delivery = $form->get('addresses')->getData(); 
            $delivery_content = $delivery->getFirstName() . ' ' . $delivery->getLastName();
            $delivery_content .= '<br/>' . $delivery->getPhone();
        }

        //Enregistrer ma commande order()
        $order = new Order();
        $order->setUser($this->getUser());
        $order->setCreatedAt($date);
        $order->setCarrierName($carriers->getName());
        $order->setCarrierPrice($carriers->getPrice());
        $order->setDelivery($delivery_content);
        //$order->setisPaid(isPaid: 0);

        //Enregistrer mes produits OrderDetails()
        foreach($cart->getFull() as $product){
            $orderDetails = new OrderDetails();
            //$orderDetails->setOrder($order_);
            $orderDetails->setProduct($product['product']->getName());
            $orderDetails->setQuantity($product['quantity']);
            $orderDetails->setPrice($product['product']->getPrice());
            $orderDetails->setTotal(total: $product['quantity']->getPrice() * $product['quantity']);
            $this->entityManager->persist($orderDetails);
        }

        return $this->render('checkout/index.html.twig', [
            'controller_name' => 'CheckoutController',
        ]);

    }
}


