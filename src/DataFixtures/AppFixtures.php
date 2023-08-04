<?php

namespace App\DataFixtures;

use App\Entity\MedicalFile;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $listMedicalFile = [];
        for ($i = 0;$i<20; $i++) {
            $medicalFile = new MedicalFile;
            $medicalFile->setReservationId($i);
            $medicalFile->setAllergies("Allergie".$i);
            $manager->persist($medicalFile);
            $listMedicalFile[] = $medicalFile;
        }

        //Création des users    
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setGender("gender".$i);
            $user->setLastName("LasName".$i);
            $user->setFirstName("FirstName".$i);
            $user->setAddress("address".$i);
            $user->setEmailAddress("email".$i);
            $user->setPassword("password".$i);
            $user->setSocialSecurity($i.$i.$i);
            $user->setIsAdmin(0);
            $user->setMedicalFile($listMedicalFile[$i]);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
