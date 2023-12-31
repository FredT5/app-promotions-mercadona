<?php

namespace App\Tests\Unit;

use App\Entity\Product;
use App\Entity\Category;
use DateTime;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testIsTrue()
    {
        $product = new Product();
        $dateTime = new DateTime();
        $categorie = new Category();

        $product->setName('nom')
                ->setDescription('description')
                ->setPrice('25.99')
                ->setDiscount(10)
                ->setDiscountStart($dateTime)
                ->setDiscountEnd($dateTime)
                ->setImage('image')
                ->setCategory($categorie)
                ->setSlug('slug');

        $this->assertTrue($product->getName() === 'nom');
        $this->assertTrue($product->getDescription() === 'description');
        $this->assertTrue($product->getPrice() === '25.99');
        $this->assertTrue($product->getDiscount() === 10);
        $this->assertTrue($product->getDiscountStart() === $dateTime);
        $this->assertTrue($product->getDiscountEnd() === $dateTime);
        $this->assertTrue($product->getImage() === 'image');
        $this->assertTrue($product->getCategory() === $categorie);
        $this->assertTrue($product->getSlug() === 'slug');
    }

    public function testIsFalse()
    {
        $product = new Product();
        $dateTime = new DateTime();
        $categorie = new Category();

        $product->setName('nom')
                ->setDescription('description')
                ->setPrice('25.99')
                ->setDiscount(10)
                ->setDiscountStart($dateTime)
                ->setDiscountEnd($dateTime)
                ->setImage('image')
                ->setCategory($categorie)
                ->setSlug('slug');

        $this->assertFalse($product->getName() === 'false');
        $this->assertFalse($product->getDescription() === 'false');
        $this->assertFalse($product->getPrice() === '22.20');
        $this->assertFalse($product->getDiscount() === 20);
        $this->assertFalse($product->getDiscountStart() === new DateTime());
        $this->assertFalse($product->getDiscountEnd() === new DateTime());
        $this->assertFalse($product->getImage() === 'false');
        $this->assertFalse($product->getCategory() === new Category(), );
        $this->assertFalse($product->getSlug() === 'false');
    }

    public function testIsEmpty()
    {
        $product = new Product();

        $this->assertEmpty($product->getName());
        $this->assertEmpty($product->getDescription());
        $this->assertEmpty($product->getPrice());
        $this->assertEmpty($product->getDiscount());
        $this->assertEmpty($product->getDiscountStart());
        $this->assertEmpty($product->getDiscountEnd());
        $this->assertEmpty($product->getImage());
        $this->assertEmpty($product->getCategory());
        $this->assertEmpty($product->getSlug());
        $this->assertEmpty($product->getId());
    }
}