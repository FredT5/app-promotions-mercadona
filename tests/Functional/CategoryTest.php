<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryTest extends WebTestCase
{
    public function testShouldDisplayCatalog(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/catalogue/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Tous nos produits');
    }

    public function testShouldDisplayCatalogCategory(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/catalogue/test-category');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Test category');
    }
}
