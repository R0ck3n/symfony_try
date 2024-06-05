<?php

namespace App\Controller;

use App\Entity\Cocktail;
use App\Form\CocktailType;
use App\Repository\CocktailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin')]
class BackCocktailController extends AbstractController
{
    #[Route('/ajouter', name: 'back_coktail_ajouter')]
    public function ajouter(EntityManagerInterface $em, Request $request): Response
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

    }


    #[Route('/update/{id}', name: 'back_coktail_update')]
    public function update(Cocktail $cocktail, EntityManagerInterface $em, Request $request): Response
    {

        $formCocktail = $this->createForm(CocktailType::class, $cocktail);
        $formCocktail->handleRequest($request);
    
        if ($formCocktail->isSubmitted() && $formCocktail->isValid()) {

            $em->flush();
    
            // Ajouter un message flash
            $this->addFlash('success', 'Profil mis à jour avec succès.');
    
            // Redirection après la mise à jour
            return $this->redirectToRoute("front_cocktail_home");
        }

        return $this->render('main/update.html.twig', [
            'controller_name' => 'Team builder',
            'formCocktail' => $formCocktail->createView(),
            'people' => $cocktail
        ]);

    }

    #[Route('/delete/{id}', name: 'back_coktail_delete')]
    public function delete(Cocktail $cocktail,EntityManagerInterface $em): Response
    {   
        $firstname = $cocktail->getFirstname();
        $lastname = $cocktail->getLastname();

        $em->remove($cocktail);
        $em->flush();  
        $this->addFlash('danger', $firstname . ' ' . $lastname . ' supprimé avec succès.');

        return $this->redirectToRoute("front_cocktail_home");
        
    }


}
