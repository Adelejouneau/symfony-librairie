<?php

namespace App\DataFixtures;

use App\Entity\Livre;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LivreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $livre = new Livre();
        $livre->setTitre("Boule et Bil, Tel Boule tel Bill");
        $livre->setDescription("Boule et Bill est une série de bande dessinée jeunesse humoristique belge, 
        nommée d'après ses deux personnages principaux. Créée en 1959 par Jean Roba, 
        elle a été reprise en 2003 par Laurent Verron puis fin 2016 par le scénariste Christophe Cazenove et le 
        dessinateur Jean Bastide");
        $livre->setImageName("bouleetbill-telbouletelbill.jpg");
        $livre->setSlug("boule-et-bill-tel-boule-tel-bill");
        $livre->setCategorie($this->getReference(CategorieFixtures::BANDE_DESSINEE));
        $livre->addAuteur($this->getReference(AuteurFixtures::JEAN_ROBA));
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setTitre("Mort sur le Nil");
        $livre->setDescription("roman policier d'Agatha Christie publié le 1er novembre 1937 au Royaume-Uni chez 
        Collins Crime Club, mettant en scène une des plus célèbres enquêtes du détective belge Hercule Poirot");
        $livre->setImageName("mortsurlenil.jpg");
        $livre->setSlug("mort-sur-le-nil");
        $livre->setCategorie($this->getReference(CategorieFixtures::ROMAN_POLICIER));
        $livre->addAuteur($this->getReference(AuteurFixtures::AGATHA_CHRISTIE));
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setTitre("A propos d'amour");
        $livre->setDescription("Définissant l\'amour comme un acte et non comme un sentiment, bell hooks démonte 
        tous les obstacles que la culture patriarcale oppose à des relations d\'amour.");
        $livre->setImageName("a-propos-damour.jpg");
        $livre->setSlug("a-propos-damour");
        $livre->setCategorie($this->getReference(CategorieFixtures::ESSAI_PHILOSOPHIQUE));
        $livre->addAuteur($this->getReference(AuteurFixtures::BELL_HOOKS));
        $manager->persist($livre);
        
        $manager->flush();
    }
}
