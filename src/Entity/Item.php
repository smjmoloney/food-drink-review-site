<?php
/**
 * Item Entityy
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Item
 * @package App\Entity
 *
 * @ORM\Table(name="items")
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
{
    /**
     * Auto generated id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Item name.
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * Item style.
     * @ORM\Column(type="string")
     */
    private $style;

    /**
     * Item price.
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * Item description.
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * Item rating.
     * @ORM\Column(type="float")
     */
    private $rating = 0;

    /**
     * Item rating count.
     * @ORM\Column(type="integer")
     */
    private $ratingCount = 0;

    /**
     * Item image.
     * @ORM\Column(type="string")
     */
    private $image;

    /**
     * Item visibility.
     * @ORM\Column(type="boolean")
     */
    private $visibility;

    /**
     * Item creator/username.
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * Item creation date.
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * Item constructor.
     */
    public function __construct()
    {
        $this->visibility = false;
        $this->date = new \DateTime("now");
        $this->setImage("undefined");
    }

    /**
     * Get item id.
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get item name.
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set item name.
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * Get item style.
     * @return mixed
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set item style.
     * @param $style
     */
    public function setStyle($style): void
    {
        $this->style = $style;
    }

    /**
     * Get item price.
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set item price.
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * Get item description.
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set item description.
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * Get item rating.
     * @return mixed
     */
    public function getRating()
    {
        if ($this->ratingCount < 1)
            return 0;

        return $this->rating / $this->ratingCount;
    }

    /**
     * Set item rating.
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating += $rating;
        $this->ratingCount++;
    }

    /**
     * Get item image.
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set item image.
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * Get item visibility.
     * @return bool
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set item visibility.
     * @param $visibility
     */
    public function setVisibility($visibility): void
    {
        $this->visibility = $visibility;
    }

    /**
     * Get creator/username.
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set creator/username.
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * Get date.
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date.
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * Return id and description as string.
     * @return string
     */
    public function __toString()
    {
        return $this->id . ': ' . $this->getDescription();
    }
}
