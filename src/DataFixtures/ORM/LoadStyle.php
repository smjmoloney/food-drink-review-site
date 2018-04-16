<?php
/**
 * Style Fixture
 */
namespace App\DataFixtures\ORM;

use App\Entity\Style;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadStyle
 * @package App\DataFixtures\ORM
 */
class LoadStyle implements ORMFixtureInterface
{
    /**
     * Load sample selection of styles into database.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $style = new Style();
        $style->setStyle("Thin Crust");

        $manager->persist($style);
        $manager->flush();
    }
}