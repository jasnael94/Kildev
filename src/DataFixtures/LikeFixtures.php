<?php

namespace App\DataFixtures;

use App\Entity\Like;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LikeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $likes = [
            'user_0' => ['post_0', 'post_1', 'post_2', 'post_3', 'post_4', 'post_5'],
            'user_1' => ['post_3', 'post_4', 'post_5', 'post_6', 'post_7', 'post_8'],
            'user_2' => ['post_6', 'post_7', 'post_8'],
            'user_3' => ['post_9', 'post_10', 'post_11'],
            'user_4' => ['post_12', 'post_13', 'post_14', 'post_15', 'post_16', 'post_17'],
            'user_5' => ['post_15', 'post_16', 'post_17'],
            'user_6' => ['post_18', 'post_19'],
            'user_7' => ['post_0', 'post_1', 'post_2'],
            'user_8' => ['post_3', 'post_4', 'post_5', 'post_6', 'post_7', 'post_8'],
            'user_9' => ['post_6', 'post_7', 'post_8'],
            'user_10' => ['post_9', 'post_10', 'post_11'],
            'user_11' => ['post_12', 'post_13', 'post_14', 'post_15', 'post_16', 'post_17'],
            'user_12' => ['post_15', 'post_16', 'post_17'],
            'user_13' => ['post_18', 'post_19', 'post_0', 'post_1', 'post_2'],
            'user_14' => ['post_0', 'post_1', 'post_2'],
            'user_15' => ['post_3', 'post_4', 'post_5'],
            'user_16' => ['post_6', 'post_7', 'post_8'],
            'user_17' => ['post_9', 'post_10', 'post_11', 'post_12', 'post_13', 'post_14'],
            'user_18' => ['post_12', 'post_13', 'post_14'],
            'user_19' => ['post_15', 'post_16', 'post_17', 'post_18', 'post_19']
        ];

        // Pour chaque utilisateur, on créer le même nombre de likes que de posts

        foreach ($likes as $userReference => $postReferences) { // boucle des utilisateurs
            $user = $this->getReference($userReference, User::class);

            foreach ($postReferences as $postReference) { // boucle des posts
                $post = $this->getReference($postReference, Post::class);

                $like = new Like();
                $like->setLiker($user);
                $like->setPost($post);

                $manager->persist($like);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PostFixtures::class,
            UserFixtures::class,
        ];
    }
}