<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        
        for($i=0;$i<25;$i++){
            $product = new Product();
            $product
                ->setName($faker->words(1, true))
                ->setDescription($faker->text(20))
                ->setPromo($faker->boolean(50))
                ->setDisplay($faker->boolean(50))
                ->setPriceHT($faker->randomFloat(2,0,1000))
                ->setCreatedAt($faker->dateTime())
                ->setImage($faker->imageUrl());
            $manager->persist($product);
        }
       

        $manager->flush();
    }
}
