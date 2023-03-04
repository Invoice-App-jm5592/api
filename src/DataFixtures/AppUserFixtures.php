<?php

namespace App\DataFixtures;

use App\Entity\AppUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppUserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $appUser = new AppUser();
        $appUser->setName('Jean-Marc Möckel');
        $appUser->setEmail('jeanmarc@example.com');
        $appUser->setPassword('MyPassword');
        $appUser->setAddress('Some-Street-Name 33');
        $appUser->setCityCode('12345');
        $appUser->setCity('Some City');
        $appUser->setCountry('Germany');

        $manager->persist($appUser);
        $manager->flush();
    }
}
