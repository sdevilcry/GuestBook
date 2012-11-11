<?php

namespace My\GuestBookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use My\GuestBookBundle\Entity\Post;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        for ($i=0; $i<10; $i++)
        {

        $post1 = new Post();
        $post1->setEmail('gena@rada.ck.ua');
        $post1->setBody('Україно, з Днем Рідної мови! Бережімо цей скарб! Шануймося!');
        $manager->persist($post1);
        }

        $manager->flush();
    }
}