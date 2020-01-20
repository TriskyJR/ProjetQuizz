<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\User;
use App\Entity\Category;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $user = new user();
        $user->setUsername('antcoke')
             ->setPassword('12345678')
             ->confirm_password = '12345678';
        $manager->persist($user);

        // Céer 3 catégories fakées 
        for($i = 1; $i <= 3; $i++){
            $category = new Category();
            $category->setCatName($faker->sentence());

            $manager->persist($category);

            // Créer 4 à 6 articles
            $manager->flush();
            for($j = 1; $j <= mt_rand(4, 6); $j++){
                $book = new Book();

                $book->setTitle($faker->sentence())
                     ->setPageNbr($faker->numberBetween(1000, 9000))
                     ->setSample($faker->sentence(10))
                     ->setResume($faker->sentence(10))
                     ->setWriter($faker->name('male'))
                     ->setEditerName($faker->company())
                     ->setEditionYear($faker->numberBetween(2015, 2019))
                     ->setImage($faker->imageUrl(300, 300))
                     ->setCategory($category)
                     ->setUser($user);
    
                $manager->persist($book);
            }
        }
        

        
        $manager->flush();
    }
}
