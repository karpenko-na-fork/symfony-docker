<?php
/**
 * php bin/console doctrine:fixtures:load
 */

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
//use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $faker;

    //private $slug;

    public function __construct()
    {
        $this->faker = Factory::create();
        //$this->slug = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadAuthors($manager);
        $this->loadBooks($manager);
    }

    public function loadAuthors(ObjectManager $manager)
    {
        for ($i = 1; $i < 20; $i++) {
            $author = new Author();
            $authorNameEn=$this->faker->text(20);
            //$nameRu=$this->slug->slugify($post->getTitle());
            $author->setName($authorNameEn);

            $manager->persist($author);
        }
        $manager->flush();
    }

    public function loadBooks(ObjectManager $manager)
    {
        for ($i = 1; $i < 20; $i++) {
            $book = new Book();
            $bookNameEn=$this->faker->text(50);
            //$nameRu=$this->slug->slugify($post->getTitle());
            $book->setName($bookNameEn);
            $book->setAuthorId(1);

            $manager->persist($book);
        }
        $manager->flush();
    }
}
