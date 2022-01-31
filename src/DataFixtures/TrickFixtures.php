<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrickFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userJackson5 = $this->getReference('Jackson5');
        $randCategories = [];
        for ($i = 0; $i < 4; $i++) {
            $randCategories[] = $this->getReference(sprintf('category_%s', $i));
        }
        for ($i = 0; $i < 15; $i++) {
            $trick = new Trick();
            $trick->setSlug('trick-'.$i)
                  ->setName('Trick '.$i)
                  ->setDescription(sprintf('Contenu de mon %s trick', $i))
                  ->setImage('https://')
                  ->setCategory($randCategories[rand(0, 3)])
                  ->setUser($userJackson5);

            $manager->persist($trick);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class
        ];
    }
}