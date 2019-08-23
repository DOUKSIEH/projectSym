<?php

namespace App\DataFixtures;

use App\Entity\Artiste;
use App\Entity\Evenement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArtisteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
       $faker = \Faker\Factory::create('fr_FR');

        for($i = 1; $i <= mt_rand(10,15) ; $i++)
        {
          $artist = new Artiste();
          $artist->setNom($faker->lastname)
                 ->setPays($faker->country)
                 ->setStyle($faker->jobTitle)
                 ->setPresentation($faker->sentence());
          $manager->persist($artist); 

          for($j = 1 ; $j <= mt_rand(2,4); $j++)
          {
            $event = new Evenement();
                        
            $event->setType($faker->lastname)
                   ->setLieu($faker->country)
                   ->setVille($faker->city)
                   ->setDescription($faker->sentence($nbWords = 6, $variableNbWords = true))
                   ->setPrix(mt_rand(30,100))
                   ->setDateDebut($faker->dateTimeBetween('-30 months','-24 months'));
                
                
                $interval = (new \DateTime())->diff($event->getDateDebut())->days;
                
                  
            $event->setDateFin($faker->dateTimeBetween('-'. $interval. ' days'))
                  ->setArtist($artist);

            $manager->persist($event); 
            
          } 
        }

        $manager->flush();
    }
}
