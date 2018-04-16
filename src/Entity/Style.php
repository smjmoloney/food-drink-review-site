<?php
/**
 * Style Entity
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Style
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\StyleRepository")
 */
class Style
{
    /**
     * Auto-incremented integer for Style id.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * Style name
     * @ORM\Column(type="string")
     */
    private $style;

    /**
     * Returns the id of a generated row.
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the style of a generated row.
     * @return mixed
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Sets the style of a generated row.
     * @param $style
     */
    public function setStyle($style): void
    {
        $this->style = $style;
    }
}
