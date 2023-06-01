<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $encoder): Response
    {
        //on récupère l'utilisateur
        $user = $this->getUser();
        //On créé un formulaire avec les données de l'utilisateur
        $form = $this->createForm(UserType::class, $user);
        //
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // On vérifie si l'utilisateur a changé de mot de passe
            if (!is_null($request->request->get('plainPassword'))){
            //On encode le nouveau password et on l'affecte au user
            $password = $encoder->hashPassword($user, $request->request->get('plainPassword'));
            $user->setPassword($password);
            }
        //On met en place un message flash
        $this->addFlash('success', 'Votre profil a bien été modifié');
        //On enregistre les modifications 
        $em->persist($user);
        $em->flush();
        //On redirige vers la home
        return $this->redirectToRoute('app_home');
        }
        return $this->render('profil/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add-favori/{id}', name: 'app_favori')]
    public function addFavori($id, LivreRepository $livreRepository, EntityManagerInterface $em): Response
    {
        //on récupère le livre dans la base de donnée (car il nous faut l'objet livre)
        $livre = $livreRepository->find($id);
        //On récupère l'utilisateur 
        $user = $this->getUser();
        //On ajoute le livre à la liste des favoris de l'utilisateur 
        $user->addLivre($livre);
        //On met en place un message flash
        $this->addFlash('success', 'Le livre a bien été ajouté à vos favoris');
        //On enregistre les modifications 
        $em->persist($user);
        $em->flush();
        //On redirige vers la page des livres 
        return $this->redirectToRoute('app_livre');

    }

    #[Route('/remove-favori/{id}', name: 'remove_favori')]
    public function removeFavori($id, LivreRepository $livreRepository, EntityManagerInterface $em): Response
    {
        //on récupère le livre dans la base de donnée (car il nous faut l'objet livre)
        $livre = $livreRepository->find($id);
        //On récupère l'utilisateur 
        $user = $this->getUser();
        //On ajoute le livre à la liste des favoris de l'utilisateur 
        $user->removeLivre($livre);
        //On met en place un message flash
        $this->addFlash('success', 'Le livre a bien été retiré à vos favoris');
        //On enregistre les modifications 
        $em->persist($user);
        $em->flush();
        //On redirige vers la page des livres 
        return $this->redirectToRoute('app_profil');

    }
}
