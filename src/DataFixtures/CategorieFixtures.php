<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();

        $categorie = new Categorie();
        $categorie->setNom('Bande dessinée');
        $categorie->setSlug('bande-dessinee');
        $manager->persist($categorie);

        $categorie = new Categorie();
        $categorie->setNom('Roman policier');
        $categorie->setSlug('roman-policier');
        $manager->persist($categorie);

        $categorie = new Categorie();
        $categorie->setNom('Essai philosophique');
        $categorie->setSlug('essai-philosophique');
        $manager->persist($categorie);

        $manager->flush();
    }
}
