<?php

namespace App\Classe;

use App\Entity\Coupon;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\Common\Collections\ArrayCollection;

Class Cart
{

    private $entityManager;
    private $requestStack;

    public function __construct(EntityManagerInterface $entityManager,RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

// la fonction getFull() pour recuperer les données
    public function getFull(){

        
        
        $cartComplete =[];

        if ($this->get()){
            foreach($this->get() as $id => $quantity){
                $product_object = $this->entityManager->getRepository(Product::class)->findOneById($id);
                if (!$product_object){
                    $this->delete($id);
                    continue;

                }
                $cartComplete[]=[
                    'product'=> $product_object,
                    'quantity' => $quantity
                ];
            
            }
        }
        return $cartComplete;
    }

// la fonction add() pour ajouter un produit au panier
    public function add($id)
    {

       $session = $this->requestStack->getSession();

        $cart =$session->get('cart',[]);

        if(!empty($cart[$id])){
            $cart[$id]++;
        }else{
            $cart[$id]=1;
        }


        $session->set('cart', $cart);
    }

    public function get()
    {
        $session = $this->requestStack->getSession();
        
        return $session->get('cart');
    }
// Fonction Pour supprimer touuut le panier, test
    public function remove()
    {
        $session = $this->requestStack->getSession();
        return $session->remove('cart');
    }

// Fonction Pour supprimer un element du panier
public function delete($id)
    {
        $session = $this->requestStack->getSession();
        $cart =$session->get('cart',[]);
        unset($cart[$id]);
        return $session->set('cart', $cart);
    }

    public function decrease($id)
    {
        $session = $this->requestStack->getSession();
        $cart =$session->get('cart',[]);
        //Verifier si la quantite du produit est superieur a 1
        if ($cart[$id] > 1){
            //deminuer la quantité
            $cart[$id]--;


        }else{
            //SUPPRIMER le produit meme
            unset($cart[$id]);
        }
        // retourner la session
        return $session->set('cart', $cart);

    }

    

    
}
?>