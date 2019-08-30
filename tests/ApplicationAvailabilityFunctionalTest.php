<?php

namespace App\tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        //requete http
        $client = self::createClient();
        //Permet de naviguer dans la page trouver
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
   /**
    * Ce code vérifie que toutes les URL fournies se chargent correctement, ce qui signifie que leurs codes HTTP de réponse se situe entre 200 et 299. 
    *
    * @return void
    */
    public function urlProvider()
    {
        return array(
            yield ['/fr/'],//array
            yield ['/fr/commande'],
            yield ['/fr/login'],
            yield ['/fr/event']
           
        );
    }
}