<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

;

class ProductFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        // use the factory to create a Faker\Generator instance
        // create a French faker
        $faker = Faker\Factory::create('fr_FR');
        
        for($i = 1; $i <= 12; $i++){
            $product = new Product();
            $product->setName($faker->text(15));
            $product->setDescription($faker->text(100));
            $product->setSlug($this->slugger->slug($product->getName())->lower());
            $product->setPrice($faker->numberBetween(300,15000));
            $product->setImage('assets/images/agua-1.jpg');
            $product->setDiscount(0);

            //va chercher une référence de la categorie
            $category = $this->getReference('cat-'.rand(1,6));
            $product->setCategory($category);

            $manager->persist($product);

        }

        $manager->flush();
    }
}
