<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Anecdote;
use App\Entity\Category;
use App\Entity\Comment;

class AnecdoteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i <= 3; $i++) {
            $category = new Category();
            $category->setTitle("Titre de la category $i")
                     ->setDescription("<p>Description de la category n°$i</p>");

            $manager->persist($category);

            

            for ($j = 1; $j <= 10; $j++) {
                $anecdote = new Anecdote();
                $anecdote->setTitle("Titre de l'anecdote $j")
                         ->setContent("<p>Contenu de l'anecdote n°$j<p/>")
                         ->setImage("http://placehold.it/350x150")
                         ->setCreatedAt(new \DateTime());

                $manager->persist($anecdote);
            }
        }

        $manager->flush();
    }
}
