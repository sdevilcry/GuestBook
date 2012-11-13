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


        $post = new Post();
        $post->setEmail('gena@rada.ck.ua');
        $post->setBody(
            'Настоящий квест - это когда ты стоишь в трусах в коридоре и
                        в руках у тебя чипс, освежитель воздуха и пипетка. Задача в том, чтобы понять,
                        что ты делал до этого, и, главное, что собирался делать дальше. '
        );
        $post->setName('Gena');
        $manager->persist($post);


        $post = new Post();
        $post->setEmail('mina@rada.ck.ua');
        $post->setBody('В детском саду №7 к приезду санэпидемстанции дети тараканами выложили слово «помогите».');
        $post->setName('Mina');
        $manager->persist($post);

        $post = new Post();
        $post->setEmail('admin@ukr.net');
        $post->setBody('Проводница-блондинка на санитарных зонах открывала туалеты и закрывала купе.');
        $post->setName('Admin');
        $manager->persist($post);

        $post = new Post();
        $post->setEmail('nikolay@gmail.com');
        $post->setBody('Лев, сбежавший из зоопарка, увидел ситуацию в стране, и вернулся обратно в клетку. ');
        $post->setName('Nikolay');
        $manager->persist($post);

        $post = new Post();
        $post->setEmail('odin@ukr.net');
        $post->setBody('Счастье, это когда военкомат выслал тебе повестку, а у тебя мама директор почты. ');
        $post->setName('Odin');
        $manager->persist($post);

        $post = new Post();
        $post->setEmail('vera@rada.ck.ua');
        $post->setBody(
            'Бабушка, все говорят, что я лошара! - Ну какой же ты лошара? Пиджачок в
                        брючки, брючки в носочки, на носочках сандалики! Красавчик! '
        );
        $post->setName('Vera');
        $manager->persist($post);

        $post = new Post();
        $post->setEmail('sandy@meta.ua');
        $post->setBody('Щастье – это тада, када ты делаиш ашипки, а тибе их пращают!');
        $post->setName('Sandy');
        $manager->persist($post);

        $post = new Post();
        $post->setEmail('mars@ukr.net');
        $post->setBody('Жизнь удалась. А что толку, если об этом знаем только я и налоговая. ');
        $post->setName('Mars');
        $manager->persist($post);

        $post = new Post();
        $post->setEmail('Kino@meta.ua');
        $post->setBody('Только в России можно на вопрос: Чем занят? Услышать: Да ничем, работаю... ');
        $post->setName('Kino');
        $manager->persist($post);

        $post = new Post();
        $post->setEmail('jak@meta.ua');
        $post->setBody('Крановщик с 15-ти летним стажем за 5 минут обчистил автомат с игрушками. ');
        $post->setName('Jak');
        $manager->persist($post);

        $manager->flush();
    }
}