<?php

namespace App\Tests\Unit;

use App\Entity\Category;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testIsTrue()
    {
        $category = new Category();

        $category->setName('nom')
                 ->setSlug('slug');

        $this->assertTrue($category->getName() === 'nom');
        $this->assertTrue($category->getSlug() === 'slug');
    }

    public function testIsFalse()
    {
        $category = new Category();

        $category->setName('nom')
                 ->setSlug('slug');

        $this->assertFalse($category->getName() === 'false');
        $this->assertFalse($category->getSlug() === 'false');
    }

    public function testIsEmpty()
    {
        $category = new Category();

        $category->setName('')
                 ->setSlug('');

        $this->assertEmpty($category->getName());
        $this->assertEmpty($category->getSlug());
        $this->assertEmpty($category->getId());
    }

    public function testAddGetRemoveProduct()
    {
        // create a category
        $category = new Category();
        // create a product
        $product = new Product();

        // first, check that when it getProducts, it's empty
        $this->assertEmpty($category->getProducts());

        // then, when it addProduct
        $category->addProduct($product);
        // check that it now contains a product
        $this->assertContains($product, $category->getProducts());

        // and, when it removeProduct
        $category->removeProduct($product);
        // check that it's empty
        $this->assertEmpty($category->getProducts());
    }
}
