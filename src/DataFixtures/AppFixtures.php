<?php
namespace App\DataFixtures;
use App\Entity\Ad;
use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\Image;
use App\Entity\Events;
use App\Entity\Booking;
use App\Entity\Comment;
use App\Entity\Commande;
use App\Entity\EventLike;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture implements FixtureGroupInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');
        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);
        $adminUser = new User();
        $adminUser->setFirstName('Douksieh')
                  ->setLastName('Isman')
                  ->setEmail('douksieh@gmail.fr')
                  ->setHash($this->encoder->encodePassword($adminUser, 'password'))
                  ->setPicture('https://randomuser.me/api/portraits/men/63.jpg')
                   ->setStyle($faker->lastName())
                  ->setDescription('<p>' . join('</p><p>', $faker->paragraphs(1)) . '</p>')
                  ->addUserRole($adminRole)
                  ->setCreatedAt($faker->dateTimeBetween('-3 months'));
        $manager->persist($adminUser);
        // Nous gérons les utilisateurs
        $users = [];
        $genres = ['male', 'female'];
        for($i = 1; $i <= 10; $i++) {
            $user = new User();
            $genre = $faker->randomElement($genres);
            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1, 99) . '.jpg';
            $picture .= ($genre == 'male' ? 'men/' : 'women/') . $pictureId;
            $hash = $this->encoder->encodePassword($user, 'isman');
            $user->setFirstName($faker->firstname($genre))
                 ->setLastName($faker->lastname)
                 ->setEmail($faker->email)
                 ->setStyle($faker->jobTitle())
                 ->setDescription('<p>' . join('</p><p>', $faker->paragraphs(1)) . '</p>')
                 ->setHash($hash)
                 ->setPicture($picture)
                 ->setCreatedAt($faker->dateTimeBetween('-3 months'));
            $manager->persist($user);
            $users[] = $user;
        }

        // Nous gérons les evenements
        
        for($i = 1; $i <= 30; $i++) 
        {

            $event = new Events();
            
            
                       
            $content    = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';

            $user = $users[mt_rand(0, count($users) - 1)];

            $event->setType($faker->lastName)
                  ->setAdresse($faker->address)
                  ->setDescription($faker->paragraph(2))
                  ->setPrix(mt_rand(20,50))
                  ->setAuthor($user);
          
           
                $startDate = $faker->dateTimeBetween('-3 months');

                // Gestion de la date de fin
                $duration  = mt_rand(3, 10);
                $endDate   = (clone $startDate)->modify("+$duration days");
             
            $event->setDateDebut($startDate)
                  ->setDateFin($endDate)
                  ->setCreatedAt($faker->dateTimeBetween('-6 months','-3 months'));
                  $manager->persist($event);     

                for($j=0; $j < mt_rand(0,10); $j++)
                {

                    $like = new EventLike();
                    $like->setEvent($event)
                         ->setUser($faker->randomElement($users));
                    $manager->persist($like);
                } 
        }
        // gérer les commandes d'un utilisateur
        for($i = 1; $i <= 10; $i++) 
        {

            $commande = new Commande();
                   
                       
            $user = $users[mt_rand(0, count($users) - 1)];

            $commande->setNbcommmande($faker->numberBetween($min = 1000, $max = 9000))
                  ->setMontant(mt_rand(20,100))
                  ->setDateComd($faker->dateTimeBetween('-2 months'))
                  ->setCommandes($user);
          
                  $manager->persist($commande);     

               
        }

       $manager->flush();        
    }
   

    public static function getGroups(): array
    {
        return ['AppFixtures'];
    }

}

