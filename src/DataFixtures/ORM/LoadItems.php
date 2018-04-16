<?php
/**
 * Item Fixture
 */
namespace App\DataFixtures\ORM;


use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadItems
 * @package App\DataFixtures\ORM
 */
class LoadItems implements ORMFixtureInterface
{
    /**
     * Load sample selection of items into database.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $item = new Item();

            $item->setName("Sample Pizza " . $i);
            $item->setStyle("Regular");
            $item->setPrice(0);
            $item->setDescription("Sample Description " . $i);
            $item->setImage("undefined");

            if ($i % 2 == 0)
                $item->setVisibility(true);

            $item->setUsername('ExampleUser');

            $manager->persist($item);
        }

        $manager->flush();
    }
}