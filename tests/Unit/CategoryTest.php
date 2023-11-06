<?php

namespace App\Tests\Unit;

use App\Entity\Category;
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
    }
}
