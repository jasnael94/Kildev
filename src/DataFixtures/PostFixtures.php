<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $compteur = 0;
        for ($i = 0; $i < 20; $i++) {
            for ($j = 0; $j < rand(1, 6); $j++) {
                $post = new Post();
                $post->setContent('content' . $i);
                $post->setAuthor($this->getReference('user_' . $i, User::class));

                $manager->persist($post);

                $this->addReference('post_' . $compteur, $post);

                $compteur++;
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}