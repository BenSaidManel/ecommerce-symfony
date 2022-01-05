<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Catalogue;

use App\Repository\ProduitRepository;
use App\Repository\CatalogueRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/catalog/{id}", name="catalog")
     */
    public function Catalog($id,CatalogueRepository $catalogueRepository ,ProduitRepository $produitRepository): Response

    {

        $catalogue=$catalogueRepository->find($id);
        // return $this->json($catalogue->getProduit());
        
            $prod= $catalogue->getProduit();

        $produitsList = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        $categ= $this->getDoctrine()->getRepository(Catalogue::class)->findAll();
        
        
        
        return $this->render('index/women/CatalogSort.html.twig', ["produits"=>$produitsList ,"catalogues"=>$categ,"catalogu" => $prod]);
     
        
    }

    

    /**
     * @Route("/Catalog/{id}", name="catalog_id")
     */
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $product = $doctrine->getRepository(Produit::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for catg '.$id
            );
        }
        elseif($product->getCatalogue() == "Robe"){
            //return new Response('Check out this great product: '.$product->getnom());

        // or render a template
        // in the template, print things with {{ product.name }}
         //return $this->render('produit/show.html.twig', ['produit' => $product]);
         return $this->render('index/women/CatalogSort.html.twig', ['produits' => $product]);

        }
        
        
        //return $this->render('index/CatalogSort.html.twig', []);
        
    }
    
     /**
     * @Route("/testC", name="testC")
     */
    public function testC(CatalogueRepository $catalogueRepository , ProduitRepository $rep): Response

    {
        $catalogue=$catalogueRepository->find(4);
        // return $this->json($catalogue->getProduit());
        
            $prod= $catalogue->getProduit();
          /*  return $this->json(
                $catalogue->getProduit(),
                 Response::HTTP_OK,
                 [],
                 [
                     // ObjectNormalizer::IGNORED_ATTRIBUTES => ['user'],
                     ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object) {
                         return $object->getId();
                     }
                 ]
             );*/

        //$produitsList = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        //$categ= $this->getDoctrine()->getRepository(Catalogue::class)->findAll();
    
       return $this->render('index/women/testC.html.twig', [ "catalogues" => $prod]);
     
        
    }

    /**
     * @Route("/payement", name="payement")
     */
    public function login(): Response
    {
        return $this->render('index/payement.html.twig', []);
    }
   

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('index/Contact.html.twig', []);
    }


    

    

    /**
     * @Route("/ListProd", name="ListProd")
     */
    public function ListProd(): Response
    {    
         $produitsList = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        return $this->render('index/women/ListProd.html.twig', ["produits"=>$produitsList]);
    
     
    }
    
    /**
     * @Route("/GridProduit", name="GridProduit")
     */
    public function GridProduit(): Response
    {
        $produitsList = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        $categ= $this->getDoctrine()->getRepository(Catalogue::class)->findAll();
        return $this->render('index/women/GridProduit.html.twig', ["produits"=>$produitsList ,"catalogues"=>$categ]);
     
       
    }
}
