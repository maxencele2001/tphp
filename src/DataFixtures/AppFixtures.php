<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

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

        $user = new User();
        $user
            ->setEmail('admin@toor.com')
            ->setRoles(User::USER_ROLE[1])
            ->setPassword($this->encoder->encodePassword(
                $user,'toor'
            ));

        $manager->persist($user);

        $manager->flush();
    }
}
