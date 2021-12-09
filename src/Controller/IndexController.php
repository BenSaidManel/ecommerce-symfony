<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    /**
     * @Route("/", name="home2")
     */
    public function home2(): Response

    {
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        return $this->render('index/home2.html.twig', ["produits"=>$produits]);
    }
    
    /**
     * @Route("/list", name="produit_list")
     */
    public function list(): Response
    {
        
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();

        
        
        return $this->render('index/home2.html.twig', ["produits"=>$produits
           
        ]);
    }


    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        return $this->render('index/Login.html.twig', []);
    }
    /**
     * @Route("/sign_up", name="sign_up")
     */
    public function sign_up(): Response
    {
        return $this->render('index/sign_up.html.twig', []);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('index/Contact.html.twig', []);
    }


    /**
     * @Route("/WomenProduit", name="WomenProduit")
     */
    public function WomenProduit(): Response
    {
        return $this->render('index/WomenProduit.html.twig', []);
    }

    /**
     * @Route("/cart", name="cart")
     */
    public function cart(): Response
    {
        return $this->render('index/cart.html.twig', []);
    }

    /**
     * @Route("/Men", name="men")
     */
    public function Men(): Response
    {
        return $this->render('index/Men.html.twig', []);
    }
}
