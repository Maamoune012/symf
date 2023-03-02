<?php

namespace App\Controller;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController

{
    private $entityManager;

    function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/shop', name: 'app_shop')]
    public function index()
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();
        return $this->render('shop/index.html.twig', [
            'products' => $products,
        ]);
    }


}
