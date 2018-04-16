<?php
/**
 * Location Entity
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Location
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
{
    /**
     * Auto-incremented integer for location id.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * Location name.
     * @ORM\Column(type="string", unique=true)
     */
    private $location;

    /**
     * Returns the id of a generated row.
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the location of a generated row.
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the location of a generated row.
     * @param $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }
}
