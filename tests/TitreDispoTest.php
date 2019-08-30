<?php

namespace App\tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class TitreDispoTest extends WebTestCase
{
    /**
     * 
     */
    public function testTitrePage()
    {
        //requete http
        $client = self::createClient();
        
        //Permet de naviguer dans la page trouver
        $crawler = $client->request('GET', '/fr/events');
        
        $this->assertEquals(200,$client->getResponse()->getStatusCode());

        $test = $crawler->filter('.container h1');

        $this->assertCount(1, $test);
     
         $this->assertContains('Voici les annonces', $crawler->filter('h1')->text(),$test->text());
    }
 
}