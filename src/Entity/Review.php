<?php
/**
 * Review Entity
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Review
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{
    /**
     * Review id.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Review creator/username
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * Review text
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * Review rating.
     * @ORM\Column(type="float")
     */
    private $rating;

    /**
     * Review date.
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * Review restaurant.
     * @ORM\Column(type="string")
     */
    private $restaurant;

    /**
     * Review location.
     * @ORM\Column(type="string")
     */
    private $location;

    /**
     * Review item.
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="item")
     * @ORM\JoinColumn(nullable=false)
     */
    private $item;

    /**
     * Review constructor.
     */
    public function __construct()
    {
        $this->date = new \DateTime("now");
    }

    /**
     * Get review username.
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set review username.
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * Get review text.
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set review text.
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * Get review rating.
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set review rating.
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    /**
     * Get review rate.
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set review date.
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * Get review restaurant.
     * @return mixed
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * Set review restaurant.
     * @param mixed $restaurant
     */
    public function setRestaurant($restaurant): void
    {
        $this->restaurant = $restaurant;
    }

    /**
     * Get review location.
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set review location.
     * @param mixed $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    /**
     * Get review item.
     * @return mixed
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set review item.
     * @param mixed $item
     */
    public function setItem($item): void
    {
        $this->item = $item;
    }
}
