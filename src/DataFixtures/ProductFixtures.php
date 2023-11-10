<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

/**
 * @codeCoverageIgnore
 */

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
            $product->setName(rtrim($faker->text(15),"."))
                    ->setDescription($faker->text(100))
                    ->setSlug($this->slugger->slug($product->getName())->lower())
                    ->setPrice($faker->numberBetween(300,15000))
                    ->setImage('assets/images/agua-1.jpg')
                    ->setDiscount(0);

            //find randomly categories references
            $category = $this->getReference('cat-'.rand(1,6));
            $product->setCategory($category);

            $manager->persist($product);

        }

        // test product
        $product = new Product();
        $product->setName('Test product')
                ->setDescription($faker->text(100))
                ->setSlug($this->slugger->slug($product->getName())->lower())
                ->setPrice($faker->numberBetween(300,15000))
                ->setImage('assets/images/agua-1.jpg')
                ->setDiscount(0)
                ->setCategory($this->getReference('cat-7'));

        $manager->persist($product);

        $manager->flush();
    }
}
