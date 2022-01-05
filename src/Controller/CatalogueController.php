<?php

namespace App\Controller;

use App\Entity\Catalogue;
use App\Form\CatalogueType;
use App\Repository\ProduitRepository;
use App\Repository\CatalogueRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/catalogue")
 * 
 */
class CatalogueController extends AbstractController
{
    /**
     * @Route("/", name="catalogue_index", methods={"GET"})
     */
    public function index(CatalogueRepository $catalogueRepository , ProduitRepository $rep): Response
    {
        /*$catalogue=$catalogueRepository->find(1);
       // return $this->json($catalogue->getProduit());
        return $this->json(
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

        return $this->render('catalogue/index.html.twig', [
            'catalogues' => $catalogueRepository->findAll(),"produits"=>$rep->findAll()
        ]);
       
    }

   

    /**
     * @Route("/new", name="catalogue_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $catalogue = new Catalogue();
        $form = $this->createForm(CatalogueType::class, $catalogue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($catalogue);
            $entityManager->flush();

            return $this->redirectToRoute('catalogue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('catalogue/new.html.twig', [
            'catalogue' => $catalogue,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{nom}", name="catalogue_show", methods={"GET"})
     */
    public function show(Catalogue $catalogue ,ProduitRepository $rep): Response
    {
       
        return $this->render('catalogue/show.html.twig', [
            'catalogue' => $catalogue,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="catalogue_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Catalogue $catalogue): Response
    {
        $form = $this->createForm(CatalogueType::class, $catalogue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('catalogue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('catalogue/edit.html.twig', [
            'catalogue' => $catalogue,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="catalogue_delete", methods={"POST"})
     */
    public function delete(Request $request, Catalogue $catalogue): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catalogue->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($catalogue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('catalogue_index', [], Response::HTTP_SEE_OTHER);
    }
}
