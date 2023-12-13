<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductTest extends WebTestCase
{
    public function testShouldDisplayProductPage(): void
    {
        $client = static::createClient();

        // Test if product page exists
        $crawler = $client->request('GET', '/produit/test-product');
        $this->assertResponseIsSuccessful();

        // Test product page content
        $this->assertSelectorTextContains('small', 'Test category');
        $this->assertSelectorTextContains('h1', 'Test product');
        $this->assertSelectorTextContains('h3', '19,99 €');
    }
    public function testShouldDisplayProductLinkOnCatalogPage(): void
    {
        $client = static::createClient();
        // Test link to Test product page from catalog page
        $crawler = $client->request('GET', '/catalogue/');
        $client->clickLink('Test product');

        $this->assertResponseIsSuccessful();
    }
}
