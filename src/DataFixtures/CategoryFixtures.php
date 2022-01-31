<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; $i++) {
            $category = new Category();
            $category->setName(sprintf('Category %s', $i));
            $manager->persist($category);
            $this->addReference(sprintf('category_%s', $i), $category);
        }

        $manager->flush();
    }
}