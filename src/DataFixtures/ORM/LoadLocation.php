<?php
/**
 * Location Fixture
 */
namespace App\DataFixtures\ORM;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadLocation
 * @package App\DataFixtures\ORM
 */
class LoadLocation implements ORMFixtureInterface
{
    /**
     * Load sample selection of locations into database.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $location = new Location();
        $location->setLocation("New York");

        $manager->persist($location);
        $manager->flush();
    }
}