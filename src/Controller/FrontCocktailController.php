<?php

namespace App\Controller;

use App\Entity\Cocktail;
use App\Form\CocktailType;
use App\Repository\CocktailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontCocktailController extends AbstractController
{
    #[Route('/', name: 'front_cocktail_home')]
    public function index(CocktailRepository $cocktailRepo): Response
    {

        $cocktail = new Cocktail();
        $formCocktail = $this->createForm(CocktailType::class, $cocktail);

        $peoples = $cocktailRepo->findAll();

        // Rendre la vue avec le formulaire
        return $this->render('main/index.html.twig', [
            'controller_name' => 'Team builder',
            'formCocktail' => $formCocktail->createView(),
            'peoples' => $peoples
        ]);
    }
}
