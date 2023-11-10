<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductTest extends WebTestCase
{
    public function testShouldDisplayProduct(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/produit/test-product');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Test product');
    }
}
