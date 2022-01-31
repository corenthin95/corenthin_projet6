<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $hash = password_hash('12345', PASSWORD_DEFAULT);
        $user = new User();
        $user->setUsername('Jackson5')
             ->setEmail('jackson5@gmail.com')
             ->setPassword($hash);
        
        $manager->persist($user);
        $manager->flush();
        $this->addReference('Jackson5', $user);
    }
}