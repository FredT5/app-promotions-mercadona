<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeTest extends WebTestCase
{
    public function testShouldDisplayHome(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $linkCatalogText = $crawler->selectLink('Catalogue');
        $this->assertEquals(1, count($linkCatalogText));

        $client->clickLink('Catalogue');
        $this->assertPageTitleContains('Tous nos produits');

        $this->assertResponseIsSuccessful();
    }
}
