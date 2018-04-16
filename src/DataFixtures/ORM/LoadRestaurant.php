<?php
/**
 * Restaurant Fixture
 */
namespace App\DataFixtures\ORM;


use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadRestaurant
 * @package App\DataFixtures\ORM
 */
class LoadRestaurant implements ORMFixtureInterface
{
    /**
     * Load sample selection of restaurants into database.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $restaurant = new Restaurant();
        $restaurant->setLocation("New York");
        $restaurant->setRestaurant("Dominos");

        $manager->persist($restaurant);
        $manager->flush();
    }
}