<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use PharIo\Manifest\Author;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $users = [];
        $categorys = [];
        $articles = [];

        for ($i = 0; $i < 50; $i++) {
            //creation d'un user
            $user = new User();
            // utilisation des setters pour lui affecter des valeurs
            $user->setUsername($faker->name)
                ->setFirstname($faker->firstname)
                ->setLastname($faker->lastname)
                ->setEmail($faker->email)
                ->setPassword($faker->password)

                // on utilise \DateTime parce que c'est pas un objet que nous avons instancié, c un objet natif de PHP
                ->setCretaAt(new \DateTime);


            // enregistrer les données coté PHP
            $manager->persist($user);

            $users[] = $user;
        }
        for ($i = 0; $i < 15; $i++) {
            //creation d'une category
            $category = new Category();
            // utilisation des setters pour lui affecter des valeurs
            $category->setTitle($faker->text(50))
                ->setDescription($faker->text(500))
                ->setImage($faker->imageUrl());
            // enregistrer les données coté PHP
            $manager->persist($category);

            $categorys[] = $category;
        }
        //
        for ($i = 0; $i < 100; $i++) {
            //creation d'une category
            $article = new Article();
            // utilisation des setters pour lui affecter des valeurs
            $article->setTitle($faker->text(50))
                ->setContent($faker->text(10000))
                ->setImage($faker->imageUrl())
                ->setCreatAt(new \DateTime)
                ->setAuthor($users[$faker->numberBetween(0, 49)])
                ->addCategory($categorys[$faker->numberBetween(0, 14)]);
            // enregistrer les données coté PHP
            $manager->persist($article);

            $articles[] = $article;
        }

        $manager->flush();
    }
}
