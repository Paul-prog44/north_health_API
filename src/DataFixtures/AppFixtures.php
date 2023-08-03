<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new Users();
            $user->setGender("gender".$i);
            $user->setLastName("LasName".$i);
            $user->setFirstName("FirstName".$i);
            $user->setAddress("address".$i);
            $user->setEmailAddress("email".$i);
            $user->setPassword("password".$i);
            $user->setSocialSecurity($i.$i.$i);
            $user->setMedicalFileId($i);
            $user->setIsAdmin(0);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
