<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

;

class CategoryFixtures extends Fixture
{
    private $counter = 1;
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $this->createCategory('Agua y refrescos', $manager);
        $this->createCategory('Aperitivos', $manager);
        $this->createCategory('Azúcar y chocolate', $manager);
        $this->createCategory('Bebé', $manager);
        $this->createCategory('Carne', $manager);
        $this->createCategory('Marisco y pescado', $manager);

        $manager->flush();
    }

    public function createCategory(string $name, ObjectManager $manager)
    {
        $category= new Category();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $manager->persist($category);

        // stock réference pour la fixture product
        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;

        return $category;
    }
}
