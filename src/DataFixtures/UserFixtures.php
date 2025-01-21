<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setFirstname('firstname' . $i);
            $user->setLastname('lastname' . $i);
            $user->setBirthday(new \DateTime('now'));
            $user->setEmail('user' . $i . '@example.com');
            $user->setPassword('password' . $i);

            $manager->persist($user);

            $this->addReference('user_' . $i, $user);
        }

        $manager->flush();
    }
}