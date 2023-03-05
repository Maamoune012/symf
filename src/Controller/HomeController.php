<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Classe\Mail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // $mail = new Mail();
        // $mail->send('cheicknadiarra378@gmail.com', 'cheickna Diarra', 'premier mail', 'bonjour cheickna j espere que vous allez bien');
        $products = $this->entityManager->getRepository(Product::class)->findAll();
        return $this->render('home/index.html.twig', [
            'products' => $products,
        ]);
    }
}
