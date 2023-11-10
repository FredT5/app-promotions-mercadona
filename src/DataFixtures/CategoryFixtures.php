<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @codeCoverageIgnore
 */

class CategoryFixtures extends Fixture
{
    private $counter = 1;
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $this->createCategory('Boissons', $manager);
        $this->createCategory('Apéritifs', $manager);
        $this->createCategory('Epicerie sucrée', $manager);
        $this->createCategory('Bébé', $manager);
        $this->createCategory('Viandes', $manager);
        $this->createCategory('Poissons', $manager);
        // test category to test the category display
        $this->createCategory('Test category', $manager);

        $manager->flush();
    }

    public function createCategory(string $name, ObjectManager $manager)
    {
        $category= new Category();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $manager->persist($category);

        // generate reference for product fixtures
        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;

        return $category;
    }
}
