<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    #[Route('/livre', name: 'app_livre')]
    public function index(LivreRepository $livreRepository): Response
    {
        //on récupère tous les livres de notre base de données 
        $livres = $livreRepository->findAll();
        //on rend la page en lui passant la liste des livres 
        return $this->render('livre/index.html.twig', [
            // 'controller_name' => 'LivreController',
            'livres' => $livres,
        ]);
    }

    #[Route('/livre/{slug}', name: 'app_livre_show')]
    public function showBook($slug, LivreRepository $livreRepository): Response
    {
        // On récupère le livre correspondant au slug
        $livre = $livreRepository->findOneBy(['slug'=>$slug]);
        // On rend la page en lui passant le livre
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
        ]);
    }
}
