<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $compteur = 0;
        for ($i = 0; $i < 20; $i++) {
            for ($j = 0; $j < rand(1, 6); $j++) {
                $comment = new Comment();
                $comment->setAuthor($this->getReference('user_'. $i, User::class));
                $comment->setDescription('content' . $i);
                $comment->setPost($this->getReference('post_'. $i, Post::class));

                $manager->persist($comment);

                $this->addReference('comment_' . $compteur, $comment);

                $compteur++;
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            PostFixtures::class
        ];
    }
}