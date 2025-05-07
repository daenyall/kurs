<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $microPost1 = new MicroPost();
        $microPost1->setTitle("Witaj 1");
        $microPost1->setText("Witaj 1");
        $microPost1->setCreated(new DateTime());


        $microPost2 = new MicroPost();
        $microPost2->setTitle("Witaj 2");
        $microPost2->setText("Witaj 2");
        $microPost2->setCreated(new DateTime());

        
        $microPost3 = new MicroPost();
        $microPost3->setTitle("Witaj 3");
        $microPost3->setText("Witaj 3");
        $microPost3->setCreated(new DateTime());

        $manager->persist($microPost1);
        $manager->persist($microPost2);
        $manager->persist($microPost3);

        $manager->flush();
    }
}
