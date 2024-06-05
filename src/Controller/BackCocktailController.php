<?php

namespace App\Controller;

use App\Entity\Cocktail;
use App\Form\CocktailType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin')]
class BackCocktailController extends AbstractController
{
    #[Route('/ajouter', name: 'back_coktail_ajouter')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {

        $cocktail = new Cocktail();

        $formCocktail = $this->createForm(CocktailType::class, $cocktail);

        $formCocktail->handleRequest($request);

        if ($formCocktail->isSubmitted() && $formCocktail->isValid()) {

            $firstname = $formCocktail->get('firstname')->getData();
            $lastname = $formCocktail->get('lastname')->getData();


            $cocktail->setFirstname($firstname);
            $cocktail->setLastname($lastname);


            $em->persist($cocktail); 
            $em->flush();

            // Ajouter un message flash
            $this->addFlash('primary', 'Nouveau : ' . $firstname . ' ' . $lastname);
            return $this->redirectToRoute("front_cocktail_home");
        }

        // Rendre la vue avec le formulaire
        // return $this->render('main/index.html.twig', [
        //     'controller_name' => 'Team builder',
        //     'formCocktail' => $formCocktail->createView()
        // ]);
    }
}
