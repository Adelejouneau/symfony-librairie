<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public const BANDE_DESSINEE = "bande-dessinee";
    public const ESSAI_PHILOSOPHIQUE = "essai-philosophique";
    public const ROMAN_POLICIER = "roman-policier";
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();

        $categorie = new Categorie();
        $categorie->setNom('Bande dessinée');
        $categorie->setSlug('bande-dessinee');
        $manager->persist($categorie);
        $this->addReference(self::BANDE_DESSINEE, $categorie);

        $categorie = new Categorie();
        $categorie->setNom('Roman policier');
        $categorie->setSlug('roman-policier');
        $manager->persist($categorie);
        $this->addReference(self::ROMAN_POLICIER, $categorie);

        $categorie = new Categorie();
        $categorie->setNom('Essai philosophique');
        $categorie->setSlug('essai-philosophique');
        $manager->persist($categorie);
        $this->addReference(self::ESSAI_PHILOSOPHIQUE, $categorie);

        $manager->flush();  
    }
}
