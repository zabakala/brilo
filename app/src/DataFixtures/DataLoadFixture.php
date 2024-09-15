<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Comment;
use App\Entity\Company;
use App\Entity\Geo;
use App\Entity\Post;
use App\Entity\User;
use App\Extension\SeoExtension;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DataLoadFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $comments = json_decode(file_get_contents(__DIR__ . '/../../data/comments.json'), true);
        $posts = json_decode(file_get_contents(__DIR__ . '/../../data/posts.json'), true);
        $users = json_decode(file_get_contents(__DIR__ . '/../../data/users.json'), true);

        $userEntities = [];
        $postEntities = [];

        foreach ($users as $_user) {
            // user entity
            $user = new User();
            $user->setId($_user['id']);
            $user->setName($_user['name']);
            $user->setUsername($_user['username']);
            $user->setEmail($_user['email']);
            $user->setPhone($_user['phone']);
            $user->setWebsite($_user['website']);

            // persist user
            $manager->persist($user);

            // company entity
            $company = new Company();
            $company->setName($_user['company']['name']);
            $company->setCatchPhrase($_user['company']['catchPhrase']);
            $company->setBs($_user['company']['bs']);
            $company->setUser($user);

            // persist company
            $manager->persist($company);

            // geo entity
            $geo = new Geo();
            $geo->setLat($_user['address']['geo']['lat']);
            $geo->setLng($_user['address']['geo']['lng']);

            // persist geo
            $manager->persist($geo);

            // geo address
            $address = new Address();
            $address->setStreet($_user['address']['street']);
            $address->setSuite($_user['address']['suite']);
            $address->setCity($_user['address']['city']);
            $address->setZipcode($_user['address']['zipcode']);
            $address->setUser($user);
            $address->setGeo($geo);

            // persist geo
            $manager->persist($address);

            $userEntities[] = $user;
        }

        foreach ($posts as $_post) {
            // post entity
            $post = new Post();
            $post->setId($_post['id']);
            $post->setTitle($_post['title']);
            $post->setSeoTitle((new SeoExtension())->seo($_post['title']));
            $post->setBody($_post['body']);

            $user = array_values(array_filter($userEntities, fn($user) => $user->getId() === $_post['userId']));
            $post->setUser($user[0]);

            $postEntities[] = $post;

            $manager->persist($post);
        }

        foreach ($comments as $_comment) {
            // comment entity
            $comment = new Comment();
            $comment->setName($_comment['name']);
            $comment->setEmail($_comment['email']);
            $comment->setBody($_comment['body']);

            $post = array_values(array_filter($postEntities, fn($post) => $post->getId() === $_comment['postId']));
            $comment->setPost($post[0]);

            $manager->persist($comment);
        }

        $manager->flush();
    }
}
